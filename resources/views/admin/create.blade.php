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
            <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-800 shadow-sm">
            <h6 class="font-semibold mb-2 flex items-center">
                <i class="fas fa-times-circle mr-2"></i> Error en la creación del usuario
            </h6>
            <ul class="mb-0 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Encabezado -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-3">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-user-plus mr-2 text-green-600"></i> Crear Nuevo Usuario
        </h1>
        <a href="{{ route('gU') }}" 
           class="inline-flex items-center px-4 py-2 rounded-lg bg-white border border-gray-200 shadow-sm text-green-700 hover:bg-gray-100 transition">
            <i class="fas fa-arrow-left mr-2"></i> Volver
        </a>
    </div>

    <!-- Card del formulario -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <div class="card-header bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3">
            <h6 class="m-0 font-semibold text-lg flex items-center">
                <i class="fas fa-id-card mr-2"></i> Datos del Usuario
            </h6>
        </div>

        <div class="card-body bg-white p-4">
            <form action="{{ route('admins.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Columna izquierda -->
                    <div class="space-y-3">
                        <div>
                            <label for="name" class="form-label font-medium">Nombre(s) *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" 
                                   class="form-control rounded-lg border-gray-300" required>
                        </div>

                        <div>
                            <label for="firstLastName" class="form-label font-medium">Primer Apellido *</label>
                            <input type="text" id="firstLastName" name="firstLastName" value="{{ old('firstLastName') }}" 
                                   class="form-control rounded-lg border-gray-300" required>
                        </div>

                        <div>
                            <label for="secondLastName" class="form-label font-medium">Segundo Apellido</label>
                            <input type="text" id="secondLastName" name="secondLastName" value="{{ old('secondLastName') }}" 
                                   class="form-control rounded-lg border-gray-300">
                        </div>
                    </div>

                    <!-- Columna derecha -->
                    <div class="space-y-3">
                        <div>
                            <label for="username" class="form-label font-medium">Nombre de Usuario *</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" 
                                   class="form-control rounded-lg border-gray-300" required>
                        </div>

                        <div>
                            <label for="email" class="form-label font-medium">Correo Electrónico *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" 
                                   class="form-control rounded-lg border-gray-300" required>
                        </div>

                        <div>
                            <label for="password" class="form-label font-medium">Contraseña *</label>
                            <input type="password" id="password" name="password" minlength="8" 
                                   class="form-control rounded-lg border-gray-300" required>
                            <p class="text-xs text-gray-500 mt-1">Mínimo 8 caracteres</p>
                        </div>

                        <div>
                            <label for="role" class="form-label font-medium">Rol *</label>
                            <select id="role" name="role" class="form-select rounded-lg border-gray-300" required>
                                <option value="">Seleccionar rol...</option>
                                <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Administrador</option>
                                <option value="user" {{ old('role')=='user' ? 'selected' : '' }}>Usuario</option>
                                <option value="client" {{ old('role')=='client' ? 'selected' : '' }}>Cliente</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Botón Guardar -->
                <div class="mt-4 text-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white shadow-sm transition">
                        <i class="fas fa-save mr-2"></i> Guardar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
