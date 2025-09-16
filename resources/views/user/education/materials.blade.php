@extends('user.dashboard')
@push('styles')
<style>
@keyframes fade-in {
  from { opacity: 0; }
  to { opacity: 1; }
}
.animate-fade-in {
  animation: fade-in 1s ease-in-out both;
}

@keyframes fade-in-down {
  from { opacity: 0; transform: translateY(-20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-down {
  animation: fade-in-down 1s ease-out both;
}

@keyframes fade-in-up {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
  animation: fade-in-up 1s ease-out both;
}

@keyframes slide-up {
  from { opacity: 0; transform: translateY(40px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-slide-up {
  animation: slide-up 0.8s ease-out both;
}
</style>
@endpush
@section('content')
<div id="layoutSidenav_content" class="p-6 bg-gradient-to-br from-green-50 to-white min-h-screen overflow-x-hidden">
<!-- GUÍA PRÁCTICA: Compostaje Eficiente -->
<div class="mt-20">
    <h2 class="text-3xl font-bold text-green-800 mb-6 text-center animate-fade-in-down">
        🧠 Cómo Realizar el Compostaje de Forma Eficiente
    </h2>
    <p class="text-center max-w-3xl mx-auto text-gray-700 text-base mb-12 animate-fade-in">
        Sigue estos principios clave para lograr un compost de alta calidad, sin olores ni plagas, en el menor tiempo posible.
    </p>

    <div class="grid md:grid-cols-2 gap-6 lg:grid-cols-3">

        <!-- Equilibrio -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-8 border-emerald-400 animate-slide-up">
            <h3 class="text-lg font-bold text-emerald-700 mb-2">⚖️ Proporción 2:1</h3>
            <p class="text-gray-600 text-sm">Usa 2 partes de materiales marrones por cada 1 parte de verdes. Equilibra nitrógeno y carbono para evitar olores.</p>
        </div>

        <!-- Aireación -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-8 border-cyan-400 animate-slide-up delay-100">
            <h3 class="text-lg font-bold text-cyan-700 mb-2">🔄 Mezcla y aireación</h3>
            <p class="text-gray-600 text-sm">Remueve tu compost 1–2 veces por semana para oxigenar y acelerar la descomposición.</p>
        </div>

        <!-- Humedad -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-8 border-blue-400 animate-slide-up delay-200">
            <h3 class="text-lg font-bold text-blue-700 mb-2">💧 Humedad ideal</h3>
            <p class="text-gray-600 text-sm">Debe sentirse como una esponja escurrida. Añade marrones si está mojado, o verdes/agua si está seco.</p>
        </div>

        <!-- Tamaño -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-8 border-indigo-400 animate-slide-up delay-300">
            <h3 class="text-lg font-bold text-indigo-700 mb-2">✂️ Tamaño de residuos</h3>
            <p class="text-gray-600 text-sm">Pica o tritura los residuos para acelerar su descomposición.</p>
        </div>

        <!-- Temperatura -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-8 border-orange-400 animate-slide-up delay-400">
            <h3 class="text-lg font-bold text-orange-700 mb-2">🌡️ Temperatura óptima</h3>
            <p class="text-gray-600 text-sm">Ideal: entre 40 °C y 65 °C. Si está caliente al tacto, vas por buen camino.</p>
        </div>

        <!-- Tiempo -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-8 border-rose-400 animate-slide-up delay-500">
            <h3 class="text-lg font-bold text-rose-700 mb-2">📆 Tiempo de compostaje</h3>
            <p class="text-gray-600 text-sm">En condiciones ideales: entre 6 a 8 semanas. Sin moverlo: puede tardar 5–6 meses.</p>
        </div>

        <!-- Materiales prohibidos -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-8 border-red-500 animate-slide-up delay-600">
            <h3 class="text-lg font-bold text-red-600 mb-2">🚫 Materiales peligrosos</h3>
            <p class="text-gray-600 text-sm">Evita carnes, huesos, comida cocida, aceites, pañales, plásticos o productos químicos.</p>
        </div>

        <!-- Activadores -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-8 border-lime-400 animate-slide-up delay-700">
            <h3 class="text-lg font-bold text-lime-600 mb-2">⚡ Activadores naturales</h3>
            <p class="text-gray-600 text-sm">Agrega un poco de compost viejo, tierra, yogurt natural o estiércol para activar microbios.</p>
        </div>

        <!-- Ubicación -->
        <div class="bg-white p-6 rounded-xl shadow-lg border-l-8 border-stone-400 animate-slide-up delay-800">
            <h3 class="text-lg font-bold text-stone-600 mb-2">🏡 Ubicación ideal</h3>
            <p class="text-gray-600 text-sm">Coloca tu compostera en sombra, sobre tierra y protegida de lluvias intensas o animales.</p>
        </div>
    </div>

    <!-- Frase motivacional -->
    <div class="text-center mt-12 animate-fade-in-up">
        <p class="text-lg font-semibold text-green-700 italic">
            "Un buen compost comienza con pequeñas acciones constantes. ¡Tu basura puede nutrir la tierra!"
        </p>
    </div>
</div>


</div>
@endsection
