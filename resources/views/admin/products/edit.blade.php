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
                <i class="fas fa-edit mr-2"></i> Editar Producto
            </h6>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-3 py-1 rounded-lg bg-white text-green-700 hover:bg-gray-100 transition">
                <i class="fas fa-arrow-left mr-1"></i> Volver al listado
            </a>
        </div>

        <div class="card-body bg-white p-6">
            <form action="{{ route('products.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
                            <label class="form-label font-medium">Usuario</label>
                            <input type="text" class="form-control bg-gray-100" value="{{ $producto->user->name ?? 'Sin asignar' }}" disabled>
                        </div>

                        <div>
                            <label class="form-label font-medium">Título *</label>
                            <input type="text" name="title" class="form-control" required value="{{ old('title', $producto->title) }}">
                        </div>

                        <div>
                            <label class="form-label font-medium">Descripción *</label>
                            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $producto->description) }}</textarea>
                        </div>

                        <div>
                            <label class="form-label font-medium">Tipo de abono *</label>
                            <select name="type" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                <option value="abono_organico" {{ old('type', $producto->type)=='abono_organico'?'selected':'' }}>Orgánico</option>
                                <option value="composta" {{ old('type', $producto->type)=='composta'?'selected':'' }}>Composta</option>
                                <option value="humus" {{ old('type', $producto->type)=='humus'?'selected':'' }}>Humus</option>
                                <option value="otro" {{ old('type', $producto->type)=='otro'?'selected':'' }}>Otro</option>
                            </select>
                        </div>

                        <div>
                            <label class="form-label font-medium">Estado *</label>
                            <select name="state" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                <option value="1" {{ old('state', $producto->state)==1?'selected':'' }}>Activo</option>
                                <option value="0" {{ old('state', $producto->state)==0?'selected':'' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <!-- Columna derecha -->
                    <div class="space-y-4">
                        <div>
                            <label class="form-label font-medium">Cantidad (kg) *</label>
                            <input type="number" step="0.01" name="amount" class="form-control" required value="{{ old('amount', $producto->amount) }}">
                        </div>

                        <div>
                            <label class="form-label font-medium">Precio (Bs) *</label>
                            <input type="number" step="0.01" name="price" class="form-control" required value="{{ old('price', $producto->price) }}">
                        </div>

                        <div>
                            <label class="form-label font-medium">Imagen del producto</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        @if($producto->image)
                            <div>
                                <label class="form-label font-medium">Imagen actual:</label>
                                <div class="mt-2">
                                    <img src="{{ asset('storage/'.$producto->image) }}" alt="Imagen actual" class="rounded-lg shadow-sm w-48">
                                </div>
                            </div>
                        @endif

                        <div>
                            <label class="form-label font-medium">Enlace de Google Maps *</label>
                            <input type="url" name="link_google_maps" class="form-control"
                                   value="{{ old('link_google_maps', $producto->location->link_google_maps ?? '') }}"
                                   required placeholder="https://www.google.com/maps/place/...">
                            <small class="form-text text-gray-500">Ejemplo: https://www.google.com/maps/place/Algo/@-17.38,-66.15,15z</small>
                        </div>

                        <div>
                            <label class="form-label font-medium">Dirección *</label>
                            <textarea name="address" class="form-control" rows="2" required>{{ old('address', $producto->location->address ?? '') }}</textarea>
                        </div>
                    </div>

                </div>

                <div class="text-end mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-sm transition">
                        <i class="fas fa-save mr-2"></i> Guardar Cambios
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
