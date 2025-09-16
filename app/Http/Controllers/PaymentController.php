<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Fertilizer;
use App\Models\PaymentProduct;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Show payment form for a product
     */
    public function showForm(Fertilizer $product)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'client') {
            return redirect()->route('registro');
        }

        // Cargar relación: usuario dueño del producto + su referencia
        $product->load(['user.reference']);

        return view('payments.form', compact('product'));
    }

    public function processPayment(Request $request, Fertilizer $product)
    {
        
        $request->validate([
            'receipt' => 'required|image|max:2048',
            'amount'  => 'required|int|min:1'
        ]);

        $user = Auth::user();

        // Relación con dueño del producto
        $product = Fertilizer::with('user')->findOrFail($product->id);

        if ($request->hasFile('receipt')) {
            $fileName = time() . '_' . $request->file('receipt')->getClientOriginalName();

            // 📌 Guardar en la carpeta accesible públicamente
            $destination = $_SERVER['DOCUMENT_ROOT'] . '/uploads/payment_products';

            if (!file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            $request->file('receipt')->move($destination, $fileName);

            // Guardar en la BD la ruta relativa
            $imagePath = 'uploads/payment_products/' . $fileName;
        }
        // Subida de comprobante

        $amount = $request->amount;
        // Registro del pago
        PaymentProduct::create([
            'idFertilizer'  => $product->id,
            'idUser'   => $product->user->id,
            'idClient'   => $user->id,
            'amount'     => $amount,
            'subtotal'  => $product->price,
            'image'      => $imagePath,
            'updated_by' => $user->id,
        ]);

        // Correos involucrados
        $toVendedor = $product->user->email ?? null;
        $toCliente = $user->email;
        $comprobanteURL = 'https://compos.alwaysdata.net/'.($imagePath);


        try {
            // ------------------ CORREO PARA EL VENDEDOR ------------------
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp-esp32.alwaysdata.net';
            $mail->SMTPAuth = true;
            $mail->Username = 'esp32@alwaysdata.net';
            $mail->Password = 'ronaldmbts123$$$';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('esp32@alwaysdata.net', 'CompostajeIoT');
            $mail->isHTML(true);

            if ($toVendedor) {
                $mail->addAddress($toVendedor);
                $mail->Subject = "Tienes un nuevo pago para tu producto";
                $mail->Body = "
                <h2>¡Tienes una nueva compra!</h2>
                 <p>El cliente <strong>{$user->name}</strong> ha subido un comprobante de pago para tu producto <strong>{$product->title}</strong>.</p>
                <ul>
                <li>Cliente: {$user->name}</li>
                <li>Email: {$user->email}</li>
                <li>Producto: {$product->title}</li>
                <li>Precio: $" . number_format($product->price, 2) . "</li>
                <li>Cantidad: {$product->amount} kg</li>
                <li>Comprobante: <a href='{$comprobanteURL}' target='_blank'>Ver imagen</a></li>
                </ul>
                <p>Verifica el pago desde tu panel de administración.</p>
            ";

                $mail->send();
            }

            // ------------------ CORREO PARA EL CLIENTE ------------------
            $mail->clearAddresses(); // Limpiar antes del segundo envío
            $mail->addAddress($toCliente);
            $mail->Subject = "Tu comprobante fue recibido";
            $mail->Body = "
                <h2>Gracias por tu compra</h2>
                <p>Hola <strong>{$user->name}</strong>,</p>
                <p>Hemos recibido tu comprobante de pago para el producto <strong>{$product->title}</strong>.</p>
                <ul>
                <li>Producto: {$product->title}</li>
                <li>Cantidad: {$product->amount} kg</li>
                <li>Precio: $" . number_format($product->price, 2) . "</li>
                </ul>
                <p>Estamos verificando tu pago. Pronto recibirás la confirmación final.</p>
                <p><a href='{$comprobanteURL}' target='_blank'>Ver tu comprobante</a></p>
                <p>Gracias por confiar en <strong>CompostajeIoT </strong></p>
            ";
            $mail->send();
        } catch (Exception $e) {
            Log::error(" Error al enviar correos: " . $e->getMessage());
        }

        return redirect()->route('payment.receipt', ['product' => $product->id, 'client' => $user->id, 'amount' => $amount]);
    }

    // public function mostrarRecibo($product, $client)
    // {
    //     $pago = PaymentProduct::with(['client', 'product'])
    //         ->where('idproduct', $product)
    //         ->where('idclient', $client)
    //         ->latest()
    //         ->firstOrFail();

    //     return view('payments.receipt', compact('pago'));
    // }
    // public function descargarPDF($id)
    // {
    //     $pago = PaymentProduct::with(['client', 'product'])->findOrFail($id);

    //     // Generar número de recibo único visual (sin guardar en la BD)
    //     $receiptCode = 'CL-' . str_pad($pago->idclient, 4, '0', STR_PAD_LEFT) . '-REC-' . str_pad($pago->id, 5, '0', STR_PAD_LEFT);

    //     // Cargar vista y generar PDF
    //     $pdf = Pdf::loadView('payments.pdf', compact('pago', 'receiptCode'));

    //     // Descargar con nombre personalizado
    //     return $pdf->download($receiptCode . '.pdf');
    // }
    public function mostrarRecibo($product, $client, $amount)
    {
        $pago = PaymentProduct::with([
            'client',
            'product.user', // Cargar el dueño del producto
            'product.location' // Cargar la ubicación si es necesario
        ])
            ->where('idFertilizer', $product)
            ->where('idClient', $client)
            ->latest()
            ->firstOrFail();

        return view('payments.receipt', compact('pago', 'amount'));
    }

    /**
     * Descargar PDF del recibo
     */
    public function descargarPDF($id, $amount)
    {
        $pago = PaymentProduct::with([
            'client',
            'product.user', // Cargar el dueño del producto
            'product.location' // Cargar la ubicación si es necesario
        ])
            ->findOrFail($id);

        // Generar número de recibo único visual
        $receiptCode = 'CL-' . str_pad($pago->idclient, 4, '0', STR_PAD_LEFT) . '-REC-' . str_pad($pago->id, 5, '0', STR_PAD_LEFT);

        // Cargar vista y generar PDF
        $pdf = Pdf::loadView('payments.pdf', compact('pago', 'receiptCode', 'amount'));

        return $pdf->download($receiptCode . '.pdf');
    }
}
