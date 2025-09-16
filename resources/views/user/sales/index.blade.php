@extends('user.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-6 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">Historial de Ventas</h1>

    @if (session('success'))
        <div class="mb-6 p-4 text-green-800 bg-green-100 border border-green-300 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg shadow-lg bg-white">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-green-600">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Cliente</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Producto</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-white uppercase tracking-wider">Cantidad</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-white uppercase tracking-wider">Precio Unitario</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-white uppercase tracking-wider">Subtotal</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-white uppercase tracking-wider">Total Venta</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">Pago</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">Fecha</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($sales as $sale)
                    @foreach($sale->details as $index => $detail)
                        <tr class="hover:bg-indigo-50 transition-colors duration-150">
                            @if($index === 0)
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900" rowspan="{{ $sale->details->count() }}">
                                    {{ $sale->client->name }} {{ $sale->client->firstLastName }} {{ $sale->client->secondLastName }}
                                </td>
                            @endif

                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $detail->fertilizer->title ?? 'Producto eliminado' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-700 font-semibold">{{ $detail->amout }}</td>

                            @php
                                $subtotal = (float) $detail->subtotal;
                                $precioUnitario = $detail->amout > 0 ? $subtotal / $detail->amout : 0;
                            @endphp

                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-600">{{ number_format($precioUnitario, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-gray-600">{{ number_format($subtotal, 2) }}</td>

                            @if($index === 0)
                                <td class="px-6 py-4 whitespace-nowrap text-right font-semibold text-green-500" rowspan="{{ $sale->details->count() }}">{{ number_format((float) $sale->total, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-700" rowspan="{{ $sale->details->count() }}">{{ $sale->pay }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-500 text-sm" rowspan="{{ $sale->details->count() }}">
                                    {{ \Carbon\Carbon::parse($sale->created_at)->format('d/m/Y H:i') }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
