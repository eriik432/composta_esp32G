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
            <i class="fas fa-layer-group text-green-600 mr-2"></i>
            Gestión de Planes
        </h1>
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('plans.create') }}" 
               class="inline-flex items-center px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm font-semibold shadow-md transition">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Plan
            </a>
            <a href="{{ route('plans.delete') }}" 
               class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-700 hover:bg-gray-800 text-white text-sm font-semibold shadow-md transition">
                <i class="fas fa-trash-restore-alt mr-2"></i> Ver Planes Eliminados
            </a>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <div class="card-header bg-gradient-to-r from-green-500 to-green-600 text-white py-3">
            <h6 class="m-0 font-semibold text-lg flex items-center">
                <i class="fas fa-list mr-2"></i> Listado de Planes Disponibles
            </h6>
        </div>
        <div class="card-body bg-white">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-sm">
                    <thead class="bg-gray-100 text-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-3 py-2">Nro</th>
                            <th class="px-3 py-2">Nombre</th>
                            <th class="px-3 py-2">Descripción</th>
                            <th class="px-3 py-2">Duración (días)</th>
                            <th class="px-3 py-2">Precio</th>
                            <th class="px-3 py-2">Límite de Publicaciones</th>
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
                                <td class="px-3 py-2">{{ $plan->duration }}</td>
                                <td class="px-3 py-2">Bs {{ number_format($plan->cost, 2) }}</td>
                                <td class="px-3 py-2">{{ $plan->post_limit ?? '∞' }}</td>
                                <td class="px-3 py-2 text-center">
                                    <a href="{{ route('plans.edit', $plan->id) }}" 
                                       class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg shadow-sm transition mr-1">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </a>

                                    <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm transition"
                                                onclick="return confirm('¿Desactivar este plan?')">
                                            <i class="fas fa-trash-alt mr-1"></i> Desactivar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-gray-500 py-4">
                                    <i class="fas fa-inbox mr-2"></i>No hay planes disponibles.
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
