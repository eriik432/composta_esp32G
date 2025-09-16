@extends('user.dashboard')

@section('title', 'Materiales No Compostables')

@section('content')<div id="layoutSidenav_content" class="p-4">

    <!-- Flecha para volver atrás -->
    <div class="mb-4">
        <a href="{{route('materiales.index')}}" class="inline-flex items-center text-red-700 hover:text-red-900 font-semibold transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver
        </a>
    </div>
    <h1 class="text-4xl font-bold text-red-700 mb-6 text-center">🚫 Materiales No Compostables</h1>

    <!-- Riesgos -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">⚠️ Riesgos y Problemas Comunes</h2>
        <p class="text-gray-600">
            Incluir materiales no compostables en tu compost puede causar diversos problemas como:
        </p>
        <ul class="list-disc list-inside text-gray-600 mt-2">
            <li>Proliferación de bacterias peligrosas o patógenos.</li>
            <li>Atracción de ratas, insectos y otros animales.</li>
            <li>Malos olores por descomposición inadecuada.</li>
            <li>Contaminación del compost con sustancias químicas o no biodegradables.</li>
        </ul>
    </div>

    <!-- Ejemplos -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">❌ Ejemplos de Materiales No Compostables</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600">
            <ul class="list-disc list-inside">
                <li>Residuos de origen animal: carne, pescado, huesos, grasa, lácteos.</li>
                <li>Residuos sanitarios: pañales, papel higiénico usado, toallas sanitarias.</li>
                <li>Restos cocinados con aceite o sal.</li>
            </ul>
            <ul class="list-disc list-inside">
                <li>Materiales inorgánicos: plástico, metal, vidrio, aluminio.</li>
                <li>Papel plastificado, encerado o con tintas tóxicas.</li>
                <li>Colillas de cigarro, pilas, productos de limpieza o cosméticos.</li>
            </ul>
        </div>
    </div>

    <!-- Qué hacer con ellos -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">♻️ ¿Qué hacer con estos materiales?</h2>
        <ul class="list-disc list-inside text-gray-600">
            <li>Separar adecuadamente según el tipo de residuo (orgánico, reciclable o peligroso).</li>
            <li>Utilizar puntos verdes o centros de acopio para reciclaje.</li>
            <li>Consultar las normas locales de manejo de residuos no orgánicos.</li>
            <li>Evitar mezclarlos con residuos compostables para no arruinar tu compost.</li>
        </ul>
    </div>

    <!-- Educación -->
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">📘 Educación y Concientización</h2>
        <p class="text-gray-600">
            Muchas personas agregan estos materiales por error. Es fundamental educar a la comunidad sobre:
        </p>
        <ul class="list-disc list-inside text-gray-600 mt-2">
            <li>Qué materiales son seguros para el compost y cuáles no.</li>
            <li>Las consecuencias de contaminar el compost con residuos incorrectos.</li>
            <li>La importancia de una correcta separación de residuos en casa.</li>
        </ul>
    </div>

    <!-- Mensaje final -->
    <div class="p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
        <p class="font-medium">Recuerda:</p>
        <p>
            Aunque algunos materiales parecen “naturales”, no todos son aptos para el compost. Una buena práctica es siempre informarse antes de añadir algo nuevo a tu compostera.
        </p>
    </div>
</div>
@endsection
