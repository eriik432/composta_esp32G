@extends('admin.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-4 bg-gray-50 min-h-screen">

    <!-- Título -->
    <div class="mb-4">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-plus-circle text-green-600 mr-2"></i> Agregar Nuevo Material
        </h1>
    </div>

    <!-- Alertas -->
    @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-800 shadow-sm">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden bg-white p-6">
    <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nombre -->
        <div class="mb-4">
            <label for="name" class="block font-medium text-gray-700 mb-1">Nombre del Material</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                   placeholder="Ej: Restos de vegetales" required>
        </div>

        <!-- Imagen -->
        <div class="mb-4">
            <label for="image" class="block font-medium text-gray-700 mb-1">Imagen del Material</label>
            <input type="file" name="image" id="image"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                   accept="image/*">
        </div>

        <!-- Clasificación -->
        <div class="mb-4">
            <label for="clasification" class="block font-medium text-gray-700 mb-1">Clasificación</label>
            <select name="clasification" id="clasification"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                <option value="">Seleccione una opción</option>
                <option value="verde" {{ old('clasification')=='verde' ? 'selected' : '' }}>Verde</option>
                <option value="marron" {{ old('clasification')=='marron' ? 'selected' : '' }}>Marrón</option>
                <option value="no_compostable" {{ old('clasification')=='no_compostable' ? 'selected' : '' }}>No compostable</option>
            </select>
        </div>

        <!-- Aptitud -->
        <div class="mb-4">
            <label for="aptitude" class="block font-medium text-gray-700 mb-1">Aptitud</label>
            <select name="aptitude" id="aptitude"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="">Seleccione una opción</option>
                <option value="casero" {{ old('aptitude')=='casero' ? 'selected' : '' }}>Casero</option>
                <option value="industrial" {{ old('aptitude')=='industrial' ? 'selected' : '' }}>Industrial</option>
                <option value="no_recomendado" {{ old('aptitude')=='no_recomendado' ? 'selected' : '' }}>No recomendado</option>
            </select>
        </div>

        <!-- Tipo de categoría -->
        <div class="mb-4">
            <label for="type_category" class="block font-medium text-gray-700 mb-1">Tipo de Categoría</label>
            <select name="type_category" id="type_category"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="">Seleccione una opción</option>
                <option value="alimentos" {{ old('type_category')=='alimentos' ? 'selected' : '' }}>Alimentos</option>
                <option value="jardin" {{ old('type_category')=='jardin' ? 'selected' : '' }}>Jardín</option>
                <option value="papel_carton" {{ old('type_category')=='papel_carton' ? 'selected' : '' }}>Papel/Cartón</option>
            </select>
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label for="description" class="block font-medium text-gray-700 mb-1">Descripción</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                      placeholder="Ej: Hojas, cáscaras, y tallos crudos de vegetales.">{{ old('description') }}</textarea>
        </div>

        <!-- Botones -->
        <div class="flex justify-end">
            <a href="{{ route('materials.index') }}" 
               class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">Cancelar</a>
            <button type="submit" 
                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                Guardar Material
            </button>
        </div>

    </form>
</div>


    </div>
</div>
@endsection
