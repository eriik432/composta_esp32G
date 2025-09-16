@extends('user.dashboard')

@section('title', 'Materiales Verdes en el Compostaje')

@section('content')
<div id="layoutSidenav_content" class="p-4">

    <!-- Flecha para volver atrás -->
    <div class="mb-4">
        <a href="{{route('materiales.index')}}" class="inline-flex items-center text-green-700 hover:text-green-900 font-semibold transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver
        </a>
    </div>
    <h1 class="text-4xl font-bold text-green-700 mb-8 text-center">🍃 Materiales Verdes</h1>

    <!-- Imagen ilustrativa -->
    <div class="mb-8">
        <img src="{{ asset('images/materiales_verdes.jpg') }}" alt="Materiales verdes para compostaje" class="mx-auto rounded-lg shadow-md w-full md:w-3/4">
    </div>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">🟢 Beneficios y Precauciones</h2>
        <p class="text-gray-700 leading-relaxed">
            Los materiales verdes son ricos en nitrógeno, un nutriente esencial que alimenta a los microorganismos encargados de descomponer la materia orgánica en el compost. 
            Estos materiales incluyen restos frescos de frutas, verduras, césped, y otros residuos húmedos.
        </p>
        <p class="text-gray-700 leading-relaxed mt-2">
            Sin embargo, un exceso de materiales verdes puede hacer que el compost se vuelva demasiado húmedo, generar malos olores y dificultar la aireación, afectando el proceso de descomposición.
        </p>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">✅ Recomendaciones de Uso</h2>
        <ul class="list-disc list-inside text-gray-700 leading-loose">
            <li>Combina siempre los materiales verdes con materiales marrones para mantener un balance adecuado de nitrógeno y carbono.</li>
            <li>Mantén una proporción aproximada de 1 parte de materiales verdes por cada 2 partes de materiales marrones.</li>
            <li>Evita acumular grandes cantidades de materiales húmedos sin mezclarlos con materiales secos para prevenir malos olores.</li>
        </ul>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">✂️ Consejos de Preparación</h2>
        <ul class="list-disc list-inside text-gray-700 leading-loose">
            <li>Corta o trocea los restos verdes en piezas pequeñas para acelerar la descomposición.</li>
            <li>Evita añadir césped fresco en grandes cantidades; mejor añadirlo en capas delgadas.</li>
            <li>Mezcla bien los materiales verdes con hojas secas, cartón o ramas trituradas para mejorar la aireación y estructura del compost.</li>
        </ul>
    </section>

    <section class="mb-8 p-4 bg-green-100 border-l-4 border-green-500 rounded">
        <p class="text-green-800 font-semibold">
            💡 Consejo: Remueve regularmente tu compost para asegurar una buena oxigenación y prevenir olores desagradables.
        </p>
    </section>

    <section>
        <h2 class="text-xl font-semibold text-gray-800 mb-3">📚 Recursos Recomendados</h2>
        <ul class="list-disc list-inside text-gray-700">
            <li><a href="https://www.compostando.org/" target="_blank" class="text-green-600 hover:underline">Guía práctica de compostaje</a></li>
            <li><a href="https://www.epa.gov/recycle/composting-home" target="_blank" class="text-green-600 hover:underline">EPA - Compostaje doméstico</a></li>
        </ul>
    </section>
</div>
@endsection
