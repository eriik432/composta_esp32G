@extends('admin.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-4 bg-gray-50 min-h-screen">

    <!-- Encabezado -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-3">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-users mr-2 text-green-600"></i> Gestión de Usuarios
        </h1>
        <a href="{{ route('admins.create') }}" 
           class="inline-flex items-center px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white shadow-sm transition">
            <i class="fas fa-plus-circle mr-2"></i> Nuevo Usuario
        </a>
    </div>

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-800 shadow-sm flex items-center">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Card de tabla -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <div class="card-header bg-gradient-to-r from-green-500 to-green-600 text-white flex justify-between items-center py-3">
            <h6 class="m-0 font-semibold flex items-center">
                <i class="fas fa-list mr-2"></i> Listado de Usuarios
            </h6>
            <span class="badge bg-white text-gray-800 px-3 py-1 rounded-full shadow-sm">
                Total: {{ count($user1) }}
            </span>
        </div>

        <div class="card-body bg-white p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center text-sm" id="usersTable" width="100%">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Nombre Completo</th>
                            <th class="px-3 py-2">Email</th>
                            <th class="px-3 py-2">Rol</th>
                            <th class="px-3 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($user1 as $index => $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-2">
                                    <span class="badge bg-dark text-white">{{ $index + 1 }}</span>
                                </td>
                                <td class="px-3 py-2 text-capitalize font-medium">
                                    {{ $user->name }} {{ $user->firstLastName }} {{ $user->secondLastName }}
                                </td>
                                <td class="px-3 py-2">{{ $user->email }}</td>
                                <td class="px-3 py-2">
                                    @switch($user->role)
                                        @case('admin')
                                            <span class="px-2 py-1 rounded-full bg-blue-200 text-blue-800 font-medium flex items-center justify-center">
                                                <i class="fas fa-user-shield mr-1"></i> Admin
                                            </span>
                                            @break
                                        @case('user')
                                            <span class="px-2 py-1 rounded-full bg-gray-200 text-gray-800 font-medium flex items-center justify-center">
                                                <i class="fas fa-user mr-1"></i> Usuario
                                            </span>
                                            @break
                                        @case('client')
                                            <span class="px-2 py-1 rounded-full bg-green-200 text-green-800 font-medium flex items-center justify-center">
                                                <i class="fas fa-user-friends mr-1"></i> Cliente
                                            </span>
                                            @break
                                        @default
                                            <span class="px-2 py-1 rounded-full bg-gray-400 text-white font-medium flex items-center justify-center">
                                                <i class="fas fa-question-circle mr-1"></i> Desconocido
                                            </span>
                                    @endswitch
                                </td>
                                <td class="px-3 py-2 flex justify-center gap-2">
                                    <!-- Editar -->
                                    <a href="{{ route('admins.edit', $user) }}" 
                                       class="inline-flex items-center px-3 py-1 rounded-lg bg-yellow-400 hover:bg-yellow-500 text-white shadow-sm transition"
                                       data-bs-toggle="tooltip" title="Editar Usuario">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </a>

                                    <!-- Eliminar -->
                                    <form action="{{ route('admins.destroy', $user) }}" method="POST" 
                                          onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1 rounded-lg bg-red-600 hover:bg-red-700 text-white shadow-sm transition"
                                                data-bs-toggle="tooltip" title="Eliminar Usuario">
                                            <i class="fas fa-trash-alt mr-1"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-3 py-4 text-gray-500 text-center">
                                    <i class="fas fa-info-circle mr-1"></i> No hay usuarios registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            
        </div>
    </div>
</div>
@endsection
