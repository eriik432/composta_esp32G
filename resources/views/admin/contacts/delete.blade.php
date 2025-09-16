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
            <i class="fas fa-archive text-green-600 mr-2"></i>
            📂 Mensajes Archivados
        </h1>
        <a href="{{ route('contacts.index') }}" 
           class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-700 hover:bg-gray-800 text-white text-sm font-semibold shadow-md transition">
            <i class="fas fa-arrow-left mr-2"></i> Volver al listado
        </a>
    </div>

    <!-- Tabla -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <div class="card-header bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3">
            <h6 class="m-0 font-semibold text-lg">
                <i class="fas fa-list mr-2"></i> Lista de Mensajes Recepcionados
            </h6>
        </div>
        <div class="card-body bg-white">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-sm">
                    <thead class="bg-gray-100 text-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-3 py-2">Nro</th>
                            <th class="px-3 py-2">Nombre</th>
                            <th class="px-3 py-2">Email</th>
                            <th class="px-3 py-2">Asunto</th>
                            <th class="px-3 py-2">Mensaje</th>
                            <th class="px-3 py-2">Estado</th>
                            <th class="px-3 py-2">Fecha de Envío</th>
                            <th class="px-3 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @forelse ($messages as $message)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-2 font-medium">{{ $i++ }}</td>
                                <td class="px-3 py-2">{{ $message->full_name }}</td>
                                <td class="px-3 py-2 text-blue-600">{{ $message->email }}</td>
                                <td class="px-3 py-2">{{ $message->subject }}</td>
                                <td class="px-3 py-2 text-gray-600">{{ Str::limit($message->message, 60, '...') }}</td>
                                <td class="px-3 py-2">
                                    @switch($message->state)
                                        @case(0)
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-200 text-gray-700 font-medium">Recepcionado</span>
                                        @break

                                        @case(1)
                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-200 text-yellow-800 font-medium">Pendiente</span>
                                        @break

                                        @default
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-200 text-red-800 font-medium">Desconocido</span>
                                    @endswitch
                                </td>
                                <td class="px-3 py-2 text-gray-500">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-3 py-2 text-center">
                                    <form action="{{ route('contacts.activate', $message->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-sm transition"
                                                onclick="return confirm('¿Restaurar este mensaje?')">
                                            <i class="fas fa-trash-restore-alt mr-1"></i> Restaurar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-gray-500 py-4">
                                    <i class="fas fa-inbox mr-2"></i>No hay mensajes archivados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-4 flex justify-center">
                {{ $messages->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
