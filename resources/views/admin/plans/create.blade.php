@extends('admin.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-4 bg-gray-50 min-h-screen">

    <!-- Alertas -->
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-800 shadow-sm">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-800 shadow-sm">
            <ul class="mb-0 pl-5 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <!-- Header -->
        <div class="card-header bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-semibold text-lg flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Crear Nuevo Plan
            </h6>
            <a href="{{ route('plans.index') }}" 
               class="inline-flex items-center px-3 py-2 text-sm font-medium bg-white text-green-700 hover:bg-gray-100 rounded-lg shadow transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver al listado
            </a>
        </div>

        <!-- Body -->
        <div class="card-body bg-white p-4">
            <form action="{{ route('plans.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <!-- Nombre y Costo -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Plan *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-gray-800">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="cost" class="block text-sm font-medium text-gray-700 mb-1">Costo (Bs) *</label>
                            <input type="number" id="cost" name="cost" step="0.01" value="{{ old('cost') }}" required min="0"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-gray-800">
                        </div>
                    </div>

                    <!-- Duración y Estado -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duración (días) *</label>
                            <input type="number" id="duration" name="duration" value="{{ old('duration') }}" required min="1"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-gray-800">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-1">Estado *</label>
                            <select id="state" name="state" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-gray-800">
                                <option value="">Seleccionar estado...</option>
                                <option value="1" {{ old('state') == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('state') == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <!-- Descripción y Límite de publicaciones -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción *</label>
                            <textarea id="description" name="description" rows="4" required
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-gray-800">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="post_limit" class="block text-sm font-medium text-gray-700 mb-1">Límite de publicaciones</label>
                            <input type="number" id="post_limit" name="post_limit" value="{{ old('post_limit') }}" min="0"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-gray-800">
                            <div class="text-sm text-gray-500 mt-1">Déjalo vacío o en 0 para ilimitado</div>
                        </div>
                    </div>
                </div>

                <!-- Botón -->
                <div class="text-end mt-5">
                    <button type="submit" 
                        class="inline-flex items-center px-5 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition">
                        <i class="fas fa-save mr-2"></i> Guardar Plan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
