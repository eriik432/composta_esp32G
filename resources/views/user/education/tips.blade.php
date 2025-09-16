@extends('user.dashboard')
@section('content')
<div id="layoutSidenav_content" class='p-3'>
    <h1 class="text-2xl font-bold text-green-900 text-center mb-6">Tips para un Compostaje Exitoso</h1>

    <div class="space-y-6">
        <div class="bg-white shadow rounded-lg p-5 border-l-4 border-green-500">
            <h2 class="font-bold text-lg text-green-700">1. Equilibrio entre materiales verdes y marrones</h2>
            <p class="text-sm text-gray-700">Mantén una proporción de 1 parte verde por 2 partes marrones para evitar malos olores y acelerar el proceso.</p>
        </div>

        <div class="bg-white shadow rounded-lg p-5 border-l-4 border-blue-400">
            <h2 class="font-bold text-lg text-blue-700">2. Aireación frecuente</h2>
            <p class="text-sm text-gray-700">Voltea la mezcla cada semana para oxigenar y acelerar la descomposición.</p>
        </div>

        <div class="bg-white shadow rounded-lg p-5 border-l-4 border-yellow-400">
            <h2 class="font-bold text-lg text-yellow-700">3. Control de humedad</h2>
            <p class="text-sm text-gray-700">La composta debe sentirse como una esponja húmeda, ni muy seca ni empapada.</p>
        </div>
    </div>

    <div class="mt-10 text-center">
        <a href="{{ route('materials') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-black px-5 py-2 rounded-lg">
            Volver a Materiales
        </a>
    </div>
</div>
@endsection
