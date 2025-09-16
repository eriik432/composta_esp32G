<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Recibo de Pago - {{ $receiptCode }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
            padding: 15px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .titulo {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 3px;
            text-transform: uppercase;
        }

        .numero {
            font-size: 12px;
            color: #666;
        }

        .datos-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .datos-box {
            flex: 1;
            padding: 8px;
            background-color: #f8f9fa;
            border: 1px solid #eee;
            border-radius: 4px;
            margin: 0 5px;
        }

        .datos-titulo {
            font-size: 14px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 8px;
            padding-bottom: 4px;
            border-bottom: 1px solid #3498db;
        }

        .datos-item {
            margin-bottom: 5px;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            min-width: 100px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        table th {
            background-color: #f2f2f2;
            text-align: left;
            padding: 8px;
            font-weight: bold;
            border: 1px solid #ddd;
        }

        table td {
            padding: 8px;
            border: 1px solid #eee;
        }

        .total-section {
            margin-top: 15px;
            text-align: right;
        }

        .total-line {
            margin-bottom: 5px;
        }

        .total-final {
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
            padding-top: 5px;
            border-top: 1px solid #333;
        }

        .estado {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 11px;
        }

        .pendiente {
            background-color: #fceabb;
            color: #856404;
        }

        .aprobado {
            background-color: #d4edda;
            color: #155724;
        }

        .rechazado {
            background-color: #f8d7da;
            color: #721c24;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #666;
        }

        .info-box {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #eee;
            margin-bottom: 15px;
        }

        .status-alert {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
        }

        .status-text {
            font-size: 11px;
            color: #92400e;
            margin: 0;
        }

        .page-break {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Encabezado -->
        <div class="header page-break">
            <div class="titulo">RECIBO DE PAGO</div>
            <div class="numero">N°: {{ $receiptCode }}</div>
            <div class="numero">Fecha: {{ $pago->created_at->format('d/m/Y') }} | Hora:
                {{ $pago->created_at->format('H:i:s') }}</div>
        </div>

        <!-- Sección de datos -->
        <div class="datos-section page-break">
            <!-- Datos del Cliente -->
            <div class="datos-box">
                <div class="datos-titulo">DATOS DEL CLIENTE</div>
                <div class="datos-item"><span class="label">Nombre:</span> {{ $pago->client->name }}</div>
                <div class="datos-item"><span class="label">Correo:</span> {{ $pago->client->email }}</div>
                @if ($pago->client->username)
                    <div class="datos-item"><span class="label">Usuario:</span> {{ $pago->client->username }}</div>
                @endif
            </div>

            <!-- Datos del Vendedor -->
            <div class="datos-box">
                <div class="datos-titulo">DATOS DE LA EMPRESA</div>
                <div class="datos-item"><span class="label">Nombre:</span>
                    {{ $pago->product->user->name ?? 'No disponible' }}</div>
                <div class="datos-item"><span class="label">Correo:</span>
                    {{ $pago->product->user->email ?? 'No disponible' }}</div>
                @if ($pago->product->user->phone ?? false)
                    <div class="datos-item"><span class="label">Teléfono:</span> {{ $pago->product->user->phone }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Tabla de productos -->
        <div class="mb-6">
                <h3 class="text-base font-semibold text-gray-800 mb-3">DETALLE DEL PAGO</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Descripción
                                </th>
                                <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700 border-b">Cantidad</th>
                                <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700 border-b">Kg</th>
                                <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700 border-b">Precio
                                    Unitario kg</th>
                                    <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700 border-b">Precio
                                    Unidad</th>
                                <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700 border-b">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-800 border-b">{{ $pago->product->title }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800 border-b">{{ $amount }}</td>
                                <td class="px-4 py-3 text-sm text-center text-gray-800 border-b">
                                    {{ $pago->product->amount }} kg</td>
                                <td class="px-4 py-3 text-sm text-right text-gray-800 border-b">Bs
                                    {{ number_format($pago->product->price / $pago->product->amount, 2) }}</td>
                                <td class="px-4 py-3 text-sm text-right text-gray-800 border-b">Bs
                                    {{ number_format($pago->product->price) }}</td>
                                    <td class="px-4 py-3 text-sm text-right text-gray-800 border-b">Bs
                                    {{ number_format($pago->product->price * $amount) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        <!-- Estado y totales -->
        <div class="page-break" style="display: flex; justify-content: space-between; margin-top: 15px;">
            <div>
                <div class="datos-titulo">ESTADO DEL PAGO</div>
                <span
                    class="estado {{ $pago->state === 0 ? 'pendiente' : ($pago->state === 1 ? 'aprobado' : 'rechazado') }}">
                    @if ($pago->state === 0)
                        Rechazado
                    @elseif($pago->state === 1)
                        Pendiente
                    @else
                        Aprobado
                    @endif
                </span>
            </div>

            <div class="total-section">
                <div class="total-line">
                    <strong>Subtotal:</strong> Bs {{ number_format($pago->product->price, 2) }}
                </div>
                <div class="total-line">
                    <strong>Cantidad:</strong>{{ $amount }}
                </div>
                <div class="total-line">
                    <strong>Descuento:</strong> Bs 0.00
                </div>
                <div class="total-final">
                    <strong>TOTAL:</strong> Bs {{ number_format(($pago->product->price)*$amount) }}
                </div>
            </div>
        </div>

        <!-- Información de pago -->
        <div class="info-box page-break" style="margin-top: 15px;">
            <div class="datos-titulo">INFORMACIÓN DE PAGO</div>
            <div class="status-alert">
                <p class="status-text">
                    <strong>Estado:</strong> Pago recibido. Validación en curso por parte del equipo administrativo.
                </p>
            </div>
        </div>

        <!-- Observaciones -->
        @if ($pago->observations)
            <div class="page-break" style="margin-top: 15px;">
                <div class="datos-titulo">OBSERVACIONES</div>
                <div class="info-box">{{ $pago->observations }}</div>
            </div>
        @endif

        <!-- Pie de página -->
        <div class="footer page-break">
            <div style="font-weight: bold; margin-bottom: 5px;">¡GRACIAS POR SU CONFIANZA!</div>
            <div>www.compostaiot.free.nf</div>
            <div style="margin-top: 10px;">
                Documento generado automáticamente el {{ now()->format('d/m/Y') }}<br>
                Este documento no posee validez fiscal y se emite como constancia digital del pago recibido.
            </div>
        </div>
    </div>
</body>

</html>
