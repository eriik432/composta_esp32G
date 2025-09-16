@extends('user.dashboard')

@section('title', 'Materiales Marrones en el Compostaje')

@section('content')
<div id="layoutSidenav_content" class="p-4">

    <!-- Flecha para volver atrás -->
    <div class="mb-4">
       <a href="{{route('materiales.index')}}" class="inline-flex items-center text-yellow-700 hover:text-yellow-900 font-semibold transition duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
            Volver
        </a>
    </div>
    <h1 class="text-4xl font-bold text-yellow-700 mb-8 text-center">🟤 Materiales Marrones</h1>

    <!-- Imagen ilustrativa -->
    <div class="mb-8">
        <img src="{{ asset('images/materiales_marrones.jpg') }}" alt="Materiales marrones para compostaje" class="mx-auto rounded-lg shadow-md w-full md:w-3/4">
    </div>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">🟤 Beneficios y Precauciones</h2>
        <p class="text-gray-700 leading-relaxed">
            Los materiales marrones son fuentes importantes de carbono, que es fundamental para alimentar a los microorganismos que descomponen la materia orgánica en el compost.
            Estos materiales ayudan a mantener la estructura del compost, permitiendo una buena aireación y controlando la humedad.
        </p>
        <p class="text-gray-700 leading-relaxed mt-2">
            Sin embargo, un exceso de materiales marrones puede hacer que el proceso de compostaje se ralentice debido a la falta de nitrógeno.
        </p>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">✅ Recomendaciones de Uso</h2>
        <ul class="list-disc list-inside text-gray-700 leading-loose">
            <li>Mezcla materiales marrones con verdes en una proporción aproximada de 2:1 para un equilibrio óptimo de carbono y nitrógeno.</li>
            <li>Utiliza materiales marrones como capa superior para controlar olores y evitar la proliferación de moscas.</li>
            <li>Controla la humedad añadiendo materiales marrones cuando el compost esté demasiado húmedo.</li>
        </ul>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">✂️ Consejos de Preparación</h2>
        <ul class="list-disc list-inside text-gray-700 leading-loose">
            <li>Tritura hojas secas, ramas pequeñas y cartón para acelerar la descomposición.</li>
            <li>Evita papel con tinta tóxica o materiales plastificados que no se descomponen bien.</li>
            <li>Si el material está mojado, déjalo secar antes de añadirlo para evitar exceso de humedad.</li>
        </ul>
    </section>

    <section class="mb-8 p-4 bg-yellow-100 border-l-4 border-yellow-500 rounded">
        <p class="text-yellow-800 font-semibold">
            💡 Consejo: Mantén un balance entre materiales verdes y marrones para acelerar el proceso de compostaje y evitar malos olores.
        </p>
    </section>

    <section>
        <h2 class="text-xl font-semibold text-gray-800 mb-3">📚 Recursos Recomendados</h2>
        <ul class="list-disc list-inside text-gray-700">
            <li><a href="https://www.epa.gov/recycle/composting-home" target="_blank" class="text-yellow-700 hover:underline">EPA - Compostaje Doméstico</a></li>
            <li><a href="https://www.compost.org.uk/" target="_blank" class="text-yellow-700 hover:underline">The Composting Association</a></li>
        </ul>
    </section>
</div>
@endsection
