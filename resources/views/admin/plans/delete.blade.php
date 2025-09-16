@extends('admin.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-4 bg-gray-50 min-h-screen">

    <!-- Alertas -->
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-800 shadow-sm">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Encabezado -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-trash-alt text-red-600 mr-2"></i> Gestión de Planes Eliminados
        </h1>
        <a href="{{ route('plans.index') }}" 
           class="inline-flex items-center px-4 py-2 rounded-lg bg-white border border-gray-200 shadow-sm text-red-700 hover:bg-gray-100 transition">
            <i class="fas fa-arrow-left mr-2"></i> Volver al listado
        </a>
    </div>

    <!-- Card de tabla -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <div class="card-header bg-gradient-to-r from-orange-500 to-red-600 text-white py-3">
            <h6 class="m-0 font-semibold text-lg flex items-center">
                <i class="fas fa-list mr-2"></i> Lista de Planes Inactivos
            </h6>
        </div>

        <div class="card-body bg-white p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-sm">
                    <thead class="bg-gray-100 text-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-3 py-2">Nro</th>
                            <th class="px-3 py-2">Nombre</th>
                            <th class="px-3 py-2">Descripción</th>
                            <th class="px-3 py-2">Duración</th>
                            <th class="px-3 py-2">Precio</th>
                            <th class="px-3 py-2">Publicaciones</th>
                            <th class="px-3 py-2">Estado</th>
                            <th class="px-3 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @forelse ($plans as $plan)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-2 font-medium">{{ $i++ }}</td>
                                <td class="px-3 py-2">{{ $plan->name }}</td>
                                <td class="px-3 py-2 text-gray-600">{{ Str::limit($plan->description, 50) }}</td>
                                <td class="px-3 py-2">{{ $plan->duration }} días</td>
                                <td class="px-3 py-2">Bs {{ number_format($plan->cost, 2) }}</td>
                                <td class="px-3 py-2">{{ $plan->post_limit ?? '∞' }}</td>
                                <td class="px-3 py-2">
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-200 text-red-800 font-medium">Inactivo</span>
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <form action="{{ route('plans.activate', $plan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-sm transition"
                                            onclick="return confirm('¿Reactivar este plan?')">
                                            <i class="fas fa-trash-restore-alt mr-1"></i> Reactivar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-gray-500 py-4">
                                    <i class="fas fa-inbox mr-2"></i>No hay planes inactivos.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-4 flex justify-center">
                {{ $plans->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
