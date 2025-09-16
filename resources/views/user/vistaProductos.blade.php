@extends('user.dashboard')
@section('content')
<div id="layoutSidenav_content" class="p-4">
    {{-- Mensajes de éxito o error --}}
    @if(session('success'))
        <div class="alert alert-success text-center fw-bold">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center fw-bold">{{ session('error') }}</div>
    @endif

    {{-- Formulario de creación --}}
<div class="bg-white p-4 rounded shadow mb-5">
    <h2 class="text-success mb-4">➕ Agregar nuevo producto de abono</h2>
    <form method="POST" action="{{ route('fertilizers.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Fila 1 --}}
        <div class="row g-3 mb-3">
            <div class="col-md-3">
                <input type="text" name="title" class="form-control" placeholder="Título del producto" required>
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" name="price" class="form-control" placeholder="Precio Unidad (Bs)" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="amount" class="form-control" placeholder="Cantidad/Unidad (kg)" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="stock" class="form-control" placeholder="Stock" required>
            </div>
            <div class="col-md-2">
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
        </div>

        {{-- Fila 2 --}}
        <div class="row g-3 mb-3 align-items-end">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" id="maps_link" name="link" class="form-control" placeholder="Enlace Google Maps" required>
                    <button type="button" onclick="obtenerUbicacion()" class="btn btn-outline-primary">
                        📍
                    </button>
                </div>
            </div>
            <div class="col-md-4">
                <input type="text" name="address" class="form-control" placeholder="Dirección" required>
            </div>
            <div class="col-md-4">
                <select name="type" class="form-select" required>
                    <option value="" disabled selected>Selecciona el tipo</option>
                    <option value="composta">Composta</option>
                    <option value="humus">Humus</option>
                    <option value="abono_organico">Abono Orgánico</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
        </div>

        {{-- Descripción --}}
        <div class="mb-3">
            <textarea name="description" class="form-control" rows="3" placeholder="Descripción del producto..."></textarea>
        </div>

        {{-- Botón --}}
        <div class="text-end">
            <button type="submit" class="btn btn-success btn-lg px-4">
                <i class="fas fa-plus-circle me-2"></i>Guardar producto
            </button>
        </div>
    </form>
</div>

{{-- Script para obtener ubicación --}}
<script>
    function obtenerUbicacion() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                const link = `https://www.google.com/maps?q=${lat},${lng}`;
                document.getElementById("maps_link").value = link;
            }, function (error) {
                alert("No se pudo obtener la ubicación. Asegúrate de permitir el acceso a la ubicación.");
            });
        } else {
            alert("Tu navegador no soporta geolocalización.");
        }
    }
</script>


    {{-- Listado de productos existentes --}}
<h3 class="mb-4 text-primary">📦 Productos registrados</h3>

<div class="row">
    @forelse($fertilizers as $fertilizer)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm position-relative {{ $fertilizer->featured == 1 ? 'border border-3 border-warning bg-warning bg-opacity-10' : '' }}">
                @if ($fertilizer->featured)
                <span class="position-absolute top-0 start-0 bg-warning text-dark px-2 py-1 rounded-end small fw-bold">
                    ⭐ Destacado
                </span>
                @endif

                <!-- ✅ Check flotante -->
                <form method="POST" action="{{ route('destacado', $fertilizer->id) }}" class="position-absolute top-0 end-0 m-2">
                    @csrf
                    
                    <input type="checkbox" onchange="this.form.submit()" title="Seleccionar para revisión" {{ $fertilizer->featured == 1 ? 'checked' : '' }}>
                </form>

                @if ($fertilizer->image)
                    <img src="{{ asset( $fertilizer->image) }}" class="card-img-top" alt="{{ $fertilizer->title }}" style="height: 200px; object-fit: cover;">
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-success">{{ $fertilizer->title }}</h5>
                    <p class="card-text mb-1"><strong>Precio:</strong> Bs{{ number_format($fertilizer->price, 2) }}</p>
                    <p class="card-text mb-2"><strong>Cantidad:</strong> {{ $fertilizer->amount }} kg</p>
                    <p class="card-text mb-2"><strong>Stock:</strong> {{ $fertilizer->stock }}</p>

                    <form method="POST" action="{{ route('fertilizers.update', $fertilizer->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="text" name="title" value="{{ $fertilizer->title }}" class="form-control mb-2" required>
                        <input type="number" step="0.01" name="price" value="{{ $fertilizer->price }}" class="form-control mb-2" required>
                        <input type="number" name="amount" value="{{ $fertilizer->amount }}" class="form-control mb-2" required>
                        <input type="number" name="stock" value="{{ $fertilizer->stock }}" class="form-control mb-2" required>
                        <input type="text" name="link" value="{{ $fertilizer->location->link_google_maps }}" class="form-control mb-2" required>
                        <input type="text" name="address" value="{{ $fertilizer->location->address }}" class="form-control mb-2" required>
                        <input type="file" name="image" class="form-control mb-2" accept="image/*">
                        <textarea name="description" class="form-control mb-2" rows="2">{{ $fertilizer->description }}</textarea>

                        <select name="type" class="form-select mb-2">
                            <option value="composta" @selected($fertilizer->type == 'composta')>Composta</option>
                            <option value="humus" @selected($fertilizer->type == 'humus')>Humus</option>
                            <option value="abono_organico" @selected($fertilizer->type == 'abono_organico')>Abono Orgánico</option>
                            <option value="otro" @selected($fertilizer->type == 'otro')>Otro</option>
                        </select>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-warning w-100 me-1">
                                <i class="fas fa-save me-1"></i>Actualizar
                            </button>
                    </form>

                    <form method="POST" action="{{ route('fertilizers.destroy', $fertilizer->id) }}" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 ms-1">
                            <i class="fas fa-trash-alt me-1"></i>Eliminar
                        </button>
                    </form>
                        </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted text-center">No hay productos registrados aún.</p>
    @endforelse
</div>

</div>
@endsection
