@extends('layouts.app')

@section('content')
    @if (session('toast_message'))
        <div id="toast"
            class="fixed top-5 right-5 z-50 px-4 py-2 rounded shadow-lg text-white
                {{ Str::startsWith(session('toast_message'), '✅') ? 'bg-green-600' : 'bg-yellow-600' }}
                transition-opacity duration-500">
            {{ session('toast_message') }}
        </div>

        <script>
            // Ocultar el toast después de 4 segundos
            setTimeout(() => {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }
            }, 4000);
        </script>
    @endif

    <div class="container mx-auto px-4 max-w-3xl pt-28 pb-24">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-300">

            @php
                $receiptCode =
                    'CL-' .
                    str_pad($pago->idclient, 4, '0', STR_PAD_LEFT) .
                    '-REC-' .
                    str_pad($pago->id, 5, '0', STR_PAD_LEFT);
            @endphp

            <!-- Encabezado estilo factura -->
            <div class="flex justify-between items-start border-b pb-4 mb-6">
                <div class="w-32">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-auto w-full">
                </div>

                <div class="text-right">
                    <h1 class="text-2xl font-bold text-gray-800 uppercase">RECIBO DE PAGO</h1>
                    <div class="text-sm text-gray-600 mt-2">
                        <p><span class="font-semibold">N°:</span> <span class="font-mono">{{ $receiptCode }}</span></p>
                        <p><span class="font-semibold">Fecha:</span> {{ $pago->created_at->format('d/m/Y') }}</p>
                        <p><span class="font-semibold">Hora:</span> {{ $pago->created_at->format('H:i:s') }}</p>
                    </div>
                </div>
            </div>

            <!-- Sección de datos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Datos del Cliente -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800 border-b pb-2 mb-3">DATOS DEL CLIENTE</h3>
                    <div class="space-y-2">
                        <p><span class="font-semibold text-gray-700">Nombre:</span> {{ $pago->client->name }}</p>
                        <p><span class="font-semibold text-gray-700">Correo:</span> {{ $pago->client->email }}</p>
                        @if ($pago->client->username)
                            <p><span class="font-semibold text-gray-700">Usuario:</span> {{ $pago->client->username }}</p>
                        @endif
                    </div>
                </div>

                <!-- Datos de la Empresa -->
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800 border-b pb-2 mb-3">DATOS DE LA EMPRESA</h3>
                    <div class="space-y-2">
                        <p><span class="font-semibold text-gray-700">Nombre:</span>
                            {{ $pago->product->user->name ?? 'No disponible' }}</p>
                        <p><span class="font-semibold text-gray-700">Correo:</span>
                            {{ $pago->product->user->email ?? 'No disponible' }}</p>
                        @if ($pago->product->user->phone ?? false)
                            <p><span class="font-semibold text-gray-700">Teléfono:</span> {{ $pago->product->user->phone }}
                            </p>
                        @endif
                        @if ($pago->product->location ?? false)
                            <p><span class="font-semibold text-gray-700">Ubicación:</span>
                                {{ $pago->product->location->address ?? '' }}
                                {{ $pago->product->location->city ?? '' }}
                                {{ $pago->product->location->state ?? '' }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tabla de productos estilo factura -->
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

            <!-- Sección de totales y estado -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-6">
                <!-- Estado del pago -->
                <div class="w-full md:w-1/2">
                    <h3 class="text-base font-semibold text-gray-800 mb-2">ESTADO DEL PAGO</h3>
                    <span
                        class="inline-block px-3 py-1 rounded-full text-sm font-semibold 
                        @switch($pago->state)
                            @case(0) bg-yellow-100 text-yellow-800 @break
                            @case(1) bg-green-100 text-green-800 @break
                            @case(2) bg-red-100 text-red-800 @break
                        @endswitch">
                        @switch($pago->state)
                            @case(0)
                                Rechazado
                            @break

                            @case(1)
                                Pendiente
                            @break

                            @case(2)
                                Aprobado
                            @break
                        @endswitch
                    </span>
                </div>

                <!-- Totales -->
                <div class="w-full md:w-1/2 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex justify-between mb-1">
                        <span class="font-semibold text-gray-700">Subtotal:</span>
                        <span class="text-gray-800">Bs {{ number_format($pago->product->price, 2) }}</span>
                    </div>
                    <div class="flex justify-between mb-1">
                        <span class="font-semibold text-gray-700">Cantidad:</span>
                        <span class="text-gray-800">{{ $amount }}</span>
                    </div>
                    <div class="flex justify-between mb-1">
                        <span class="font-semibold text-gray-700">Descuento:</span>
                        <span class="text-gray-800">Bs 0.00</span>
                    </div>

                    <div class="flex justify-between mt-3 pt-2 border-t border-gray-300">
                        <span class="font-semibold text-lg text-gray-800">TOTAL:</span>
                        <span class="font-bold text-lg text-gray-900">Bs
                            {{ number_format($pago->product->price * $amount) }}</span>
                    </div>
                </div>
            </div>

            <!-- Comprobante de pago -->
            @if ($pago->image)
                <div class="mb-6">
                    <h3 class="text-base font-semibold text-gray-800 mb-3">COMPROBANTE DE PAGO</h3>
                    <img src="{{ asset($pago->image) }}" class="w-full max-w-md border rounded-md shadow-md"
                        alt="Comprobante de Pago">
                </div>
            @endif

            <!-- Observaciones -->
            @if ($pago->observations)
                <div class="mb-6">
                    <h3 class="text-base font-semibold text-gray-800 mb-2">OBSERVACIONES</h3>
                    <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded border border-gray-200">
                        {{ $pago->observations }}</p>
                </div>
            @endif

            <!-- Información de pago -->
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-6">
                <h3 class="text-base font-semibold text-gray-800 mb-3">INFORMACIÓN DE PAGO</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md mt-4">
                        <p class="text-sm text-yellow-800">
                            <strong>Estado:</strong> Pago recibido. Validación en curso por parte del equipo administrativo.
                        </p>
                    </div>

                </div>
            </div>

            <!-- Pie de página -->
            <div class="border-t pt-4 text-center">
                <p class="text-sm font-semibold text-gray-700 mb-1">¡GRACIAS POR SU CONFIANZA!</p>
                <p class="text-xs text-gray-500">www.compostajeiot.com</p>
                <p class="text-xs text-gray-500 mt-3">
                    Documento generado automáticamente el {{ now()->format('d/m/Y') }}<br>
                    Este documento no posee validez fiscal y se emite como constancia digital del pago recibido.
                </p>
            </div>

            <div class="text-center mt-6">
                <a href="{{ route('index')}}"
                    class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition-all shadow-md">
                    ← Volver
                </a>
            </div>

            <!-- Botón PDF -->
            <div class="text-center mt-8">
                <a href="{{ route('payment.downloadC', ['id' => $pago->id, 'amount' => $amount]) }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-all shadow-md">
                    Descargar Recibo en PDF
                </a>
            </div>
        </div>
    </div>
@endsection
