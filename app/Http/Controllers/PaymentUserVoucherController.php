<?php

namespace App\Http\Controllers;

use App\Models\Fertilizer;
use App\Models\PaymentVoucher;
use App\Models\PaymentProduct;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sale;
use App\Models\Detail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentUserVoucherController extends Controller
{
    public function index()
    {
        $user = Auth::User();
        $vouchers = PaymentProduct::with(['client', 'product'])
            ->where('idUser', $user->id)
            ->where('state', '>', 0)
            ->paginate(10);

        return view('user.voucher.index', compact('vouchers'));
    }

    public function edit($id)
    {
        $voucher = PaymentProduct::findOrFail($id);
        $users = User::where('state', '>', 0)->get();
        $products = Fertilizer::where('state', '>', 0)->get();
        return view('user.voucher.edit', compact('voucher', 'users', 'products'));
    }

    public function update(Request $request, $id)
    {
        $voucher = PaymentProduct::findOrFail($id);

        $request->validate([
            'observations' => 'nullable|string',
            'state' => 'required|in:0,1,2',
        ]);

        if ($request->hasFile('image')) {
    // Eliminar imagen anterior si existe
            if ($voucher->image && file_exists(public_path($voucher->image))) {
                unlink(public_path($voucher->image));
            }

            // Subir nueva imagen
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/vouchers'), $filename);

            // Guardar ruta relativa en la base de datos
            $voucher->image = 'uploads/vouchers/' . $filename;
        }

        
        $voucher->observations = $request->observations;
        $voucher->state = $request->state;
        $voucher->updated_by = Auth::id();
        $voucher->save();

        if ($request->state == 2)
        {
            try {
                DB::beginTransaction();

                // Crear venta
                $sale = Sale::create([
                    'idUser'     => auth()->id(),
                    'idClient'   => $voucher->idClient,
                    'pay'        => 'qr',
                    'total'      => $voucher->subtotal * $voucher->amount,
                ]);

                // Crear detalles
               
                Detail::create([
                        'idSale'        => $sale->id,
                        'idFertilizer'  => $voucher->idFertilizer,
                        'amout'         => $voucher->amount,
                        'subtotal'      => $voucher->subtotal,
                ]);

                $fertilizer = Fertilizer::findOrFail($voucher->idFertilizer);
                $fertilizer->stock -= $voucher->amount;
                $fertilizer->save();

                DB::commit();

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('editVoucher', $voucher->id)->with('error', $e->getMessage());

            }
        }
        return redirect()->route('editVoucher', $voucher->id)->with('success', '✅ Comprobante actualizado.');
    }


    public function delete()
    {
        $vouchers = PaymentProduct::with(['client', 'product'])
            ->where('state', 0)
            ->where('idUser', Auth::id())
            ->paginate(10);

        return view('user.voucher.delete', compact('vouchers'));
    }

    public function activate($id)
    {
        $voucher = PaymentProduct::findOrFail($id);
        $voucher->state = 1;
        $voucher->save();

        return redirect()->route('deleteC')->with('success', '✅ Comprobante reactivado.');
    }
}
