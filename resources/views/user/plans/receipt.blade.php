@extends('user.dashboard')

@section('title', 'Mi Plan Actual')

@section('content')
<div id="layoutSidenav_content" class="p-3">
    <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">Mi Plan de Servicio</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Datos del Usuario -->
            <div class="bg-gray-50 p-5 rounded-lg border border-gray-100">
                <h3 class="text-base font-semibold text-gray-800 border-b pb-2 mb-3">DATOS DEL USUARIO</h3>
                <div class="space-y-2 text-sm text-gray-700">
                    <p><span class="font-semibold">Nombre:</span> {{ $pago->user->name }}</p>
                    <p><span class="font-semibold">Correo:</span> {{ $pago->user->email }}</p>
                    @if ($pago->user->username)
                        <p><span class="font-semibold">Usuario:</span> {{ $pago->user->username }}</p>
                    @endif
                </div>
            </div>

            <!-- Detalles del Plan -->
            <div class="bg-gray-50 p-5 rounded-lg border border-gray-100">
                <h3 class="text-base font-semibold text-gray-800 border-b pb-2 mb-3">PLAN CONTRATADO</h3>
                <div class="space-y-2 text-sm text-gray-700">
                    <p><span class="font-semibold">Nombre del Plan:</span> {{ $pago->plan->name }}</p>
                    <p><span class="font-semibold">Descripción:</span> {{ $pago->plan->description }}</p>
                    <p><span class="font-semibold">Duración:</span> {{ $pago->plan->duration }} días</p>
                    <p><span class="font-semibold">Precio:</span> Bs {{ number_format($pago->plan->cost, 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Acción -->
        <div class="text-center mt-8">
            <a href="{{ route('payment.download', $pago->id) }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-all shadow-md">
                Descargar Recibo en PDF
            </a>
        </div>

    </div>
</div>
@endsection
