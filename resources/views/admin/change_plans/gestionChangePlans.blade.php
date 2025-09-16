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
            <i class="fas fa-file-invoice-dollar text-green-600 mr-2"></i>
            Gestión de Comprobantes de Cambios de Plan
        </h1>
        <a href="{{ route('change_plans.delete') }}" 
           class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-700 hover:bg-gray-800 text-white text-sm font-semibold shadow-md transition">
            <i class="fas fa-trash-restore-alt mr-2"></i> Ver Comprobantes Rechazados
        </a>
    </div>

    <!-- Tabla de Comprobantes -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <div class="card-header bg-gradient-to-r from-green-500 to-green-600 text-white py-3">
            <h6 class="m-0 font-semibold text-lg">
                <i class="fas fa-list mr-2"></i> Listado de Comprobantes Recibidos
            </h6>
        </div>
        <div class="card-body bg-white">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-sm">
                    <thead class="bg-gray-100 text-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-3 py-2">Nro</th>
                            <th class="px-3 py-2">Usuario</th>
                            <th class="px-3 py-2">Plan</th>
                            <th class="px-3 py-2">Imagen</th>
                            <th class="px-3 py-2">Observaciones</th>
                            <th class="px-3 py-2">Estado</th>
                            <th class="px-3 py-2">Fecha de Envío</th>
                            <th class="px-3 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @forelse ($change_plans as $change_plan)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-2 font-medium">{{ $i++ }}</td>
                                <td class="px-3 py-2">{{ $change_plan->user->name ?? 'N/A' }}</td>
                                <td class="px-3 py-2">{{ $change_plan->plan->name ?? 'N/A' }}</td>
                                <td class="px-3 py-2">
                                    @if ($change_plan->image)
                                        <a href="{{ asset($change_plan->image) }}" target="_blank"
                                           class="text-green-600 hover:underline">
                                           Ver imagen
                                        </a>
                                    @else
                                        <span class="text-gray-500">Sin imagen</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-gray-600">{{ $change_plan->observations ?? '—' }}</td>
                                <td class="px-3 py-2">
                                    @switch($change_plan->state)
                                        @case(0)
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-200 text-red-800 font-medium">Rechazado</span>
                                        @break

                                        @case(1)
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-200 text-yellow-800 font-medium">Pendiente</span>
                                        @break

                                        @case(2)
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-200 text-green-800 font-medium">Aprobado</span>
                                        @break
                                    @endswitch
                                </td>
                                <td class="px-3 py-2 text-gray-500">{{ $change_plan->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-3 py-2 text-center">
                                    <a href="{{ route('change_plans.edit', $change_plan->id) }}" 
                                       class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg shadow-sm transition">
                                        <i class="fas fa-edit mr-1"></i> Actualizar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-gray-500 py-4">
                                    <i class="fas fa-inbox mr-2"></i>No hay comprobantes disponibles.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-4 flex justify-center">
                {{ $change_plans->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
