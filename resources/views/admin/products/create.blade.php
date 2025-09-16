@extends('admin.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-4 bg-gray-50 min-h-screen">

    <!-- Alertas -->
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-800 shadow-sm flex items-center">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-800 shadow-sm flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Card Formulario -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <div class="card-header bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 flex justify-between items-center">
            <h6 class="m-0 font-semibold text-lg flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Crear Nuevo Producto
            </h6>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-3 py-1 rounded-lg bg-white text-green-700 hover:bg-gray-100 transition">
                <i class="fas fa-arrow-left mr-1"></i> Volver al listado
            </a>
        </div>

        <div class="card-body bg-white p-6">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-800 shadow-sm">
                        <ul class="mb-0 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Columna izquierda -->
                    <div class="space-y-4">
                        <div>
                            <label class="form-label font-medium">Asignar a Usuario *</label>
                            <select name="idUser" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">
                                        {{ $usuario->name }} {{ $usuario->firstLastName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="form-label font-medium">Título *</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div>
                            <label class="form-label font-medium">Descripción *</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>

                        <div>
                            <label class="form-label font-medium">Tipo de abono *</label>
                            <select name="type" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                <option value="abono_organico">Orgánico</option>
                                <option value="composta">Composta</option>
                                <option value="humus">Humus</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                    </div>

                    <!-- Columna derecha -->
                    <div class="space-y-4">
                        <div>
                            <label class="form-label font-medium">Cantidad (kg) *</label>
                            <input type="number" step="0.01" name="amount" class="form-control" required>
                        </div>

                        <div>
                            <label class="form-label font-medium">Precio (Bs) *</label>
                            <input type="number" step="0.01" name="price" class="form-control" required>
                        </div>

                        <div>
                            <label class="form-label font-medium">Imagen del producto</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div>
                            <label class="form-label font-medium">Enlace de Google Maps *</label>
                            <input type="url" name="link_google_maps" class="form-control"
                                   required placeholder="https://www.google.com/maps/place/...">
                            <small class="form-text text-gray-500">Ejemplo: https://www.google.com/maps/place/Algo/@-17.38,-66.15,15z</small>
                        </div>

                        <div>
                            <label class="form-label font-medium">Dirección *</label>
                            <textarea name="address" class="form-control" rows="2" required></textarea>
                        </div>

                        <!-- Campos ocultos para lat/lng -->
                        <input type="hidden" name="latitud" id="latitud">
                        <input type="hidden" name="longitud" id="longitud">
                    </div>

                </div>

                <div class="text-end mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-sm transition">
                        <i class="fas fa-save mr-2"></i> Guardar Producto
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
