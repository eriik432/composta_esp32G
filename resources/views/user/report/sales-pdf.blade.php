<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        p {
            margin: 0 0 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #aaa;
        }
        th {
            background: #f4f4f4;
            font-weight: bold;
        }
        th, td {
            padding: 6px;
            text-align: center;
        }
        .detalles {
            text-align: left;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <h2>Reporte de Ventas</h2>
    <p>Generado: {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            @php $totalGeneral = 0; @endphp
            @forelse ($ventas as $venta)
                @php $totalGeneral += $venta->total; @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($venta->created_at)->format('d/m/Y') }}</td>
                    <td>{{ $venta->client->name ?? 'N/A' }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td class="detalles">
                        @foreach ($venta->details as $detail)
                            @php
                                $type = strtolower($detail->fertilizer->type ?? '');
                            @endphp
                            @if(empty(request('tipo')) || request('tipo') == $type)
                                {{ $detail->fertilizer->title ?? 'Sin producto' }}
                                ({{ $detail->amout }} unidades) -
                                ${{ number_format($detail->subtotal, 2) }}
                                <br>
                            @endif
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No se encontraron ventas.</td>
                </tr>
            @endforelse
        </tbody>
        @if($ventas->count() > 0)
            <tfoot>
                <tr>
                    <th colspan="2">Total General</th>
                    <th>${{ number_format($totalGeneral, 2) }}</th>
                    <th></th>
                </tr>
            </tfoot>
        @endif
    </table>
</body>

</html>
