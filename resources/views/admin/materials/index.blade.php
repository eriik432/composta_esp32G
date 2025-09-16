@extends('admin.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-4 bg-gray-50 min-h-screen">

    <!-- Alertas -->
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-800 shadow-sm">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Encabezado con botón de agregar -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-boxes text-green-600 mr-2"></i>
            Gestión de Materiales
        </h1>
        <a href="{{ route('materials.create') }}" 
           class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-500 hover:bg-green-600 rounded-lg shadow-sm transition">
            <i class="fas fa-plus mr-2"></i> Agregar Material
        </a>
    </div>

    <!-- Tabla de materiales -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <div class="card-header bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3">
            <h6 class="m-0 font-semibold text-lg flex items-center">
                <i class="fas fa-list mr-2"></i> Lista de Materiales
            </h6>
        </div>
        <div class="card-body bg-white">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-sm">
                    <thead class="bg-gray-100 text-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-3 py-2">N°</th>
                            <th class="px-3 py-2">Nombre</th>
                            <th class="px-3 py-2">Descripción</th>
                            <th class="px-3 py-2">Clasificación</th>
                            <th class="px-3 py-2">Aptitud</th>
                            <th class="px-3 py-2">Tipo Categoría</th>
                            <th class="px-3 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @forelse ($materials as $material)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-2 font-medium">{{ $i++ }}</td>
                                <td class="px-3 py-2">{{ $material->name }}</td>
                                <td class="px-3 py-2">{{ $material->description }}</td>
                                <td class="px-3 py-2">{{ $material->clasification }}</td>
                                <td class="px-3 py-2">{{ $material->aptitude }}</td>
                                <td class="px-3 py-2">{{ $material->type_category }}</td>
                                <td class="px-3 py-2 text-center">
                                    <a href="{{ route('materials.edit', $material->id) }}" 
                                       class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-green-500 hover:bg-green-600 rounded-lg shadow-sm transition mr-1">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </a>
                                    
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-gray-500 py-4">
                                    <i class="fas fa-inbox mr-2"></i>No hay materiales registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-3">
                {{ $materials->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
