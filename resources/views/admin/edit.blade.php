@extends('admin.dashboard')

@section('content')
    <div id="layoutSidenav_content" class="p-4">
        {{-- Mensajes de éxito o error --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Card de edición -->
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-gradient-primary text-dark">
                <h5 class="m-0 fw-bold">
                    <i class="fas fa-user-edit me-2"></i>Editar Usuario
                </h5>
                <a href="{{ route('gU') }}" class="btn btn-light btn-sm shadow-sm">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>
            </div>

            <div class="card-body">
                {{-- Validación de errores --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Errores encontrados:</h6>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admins.update', $user) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $user->id ?? '' }}">

                    <div class="row g-4">
                        <!-- Nombre -->
                        <div class="col-md-4">
                            <label for="edit_name" class="form-label fw-bold">Nombre <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="edit_name" 
                                   name="name" 
                                   value="{{ old('name', $user->name ?? '') }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Primer Apellido -->
                        <div class="col-md-4">
                            <label for="edit_firstLastName" class="form-label fw-bold">Primer Apellido <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('firstLastName') is-invalid @enderror" 
                                   id="edit_firstLastName" 
                                   name="firstLastName" 
                                   value="{{ old('firstLastName', $user->firstLastName ?? '') }}" 
                                   required>
                            @error('firstLastName')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Segundo Apellido -->
                        <div class="col-md-4">
                            <label for="edit_secondLastName" class="form-label fw-bold">Segundo Apellido</label>
                            <input type="text" 
                                   class="form-control @error('secondLastName') is-invalid @enderror" 
                                   id="edit_secondLastName" 
                                   name="secondLastName" 
                                   value="{{ old('secondLastName', $user->secondLastName ?? '') }}">
                            @error('secondLastName')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Usuario -->
                        <div class="col-md-4">
                            <label for="edit_username" class="form-label fw-bold">Nombre de Usuario</label>
                            <input type="text" 
                                   class="form-control @error('username') is-invalid @enderror" 
                                   id="edit_username" 
                                   name="username" 
                                   value="{{ old('username', $user->username ?? '') }}">
                            @error('username')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="edit_email" class="form-label fw-bold">Correo electrónico <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="edit_email" 
                                   name="email"
                                   value="{{ old('email', $user->email ?? '') }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Rol -->
                        <div class="col-md-6">
                            <label for="edit_role" class="form-label fw-bold">Rol <span class="text-danger">*</span></label>
                            <select class="form-select @error('role') is-invalid @enderror" 
                                    id="edit_role" 
                                    name="role" 
                                    required>
                                <option value="" disabled>Seleccione un rol</option>
                                <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Administrador</option>
                                <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>Usuario</option>
                                <option value="client" {{ old('role', $user->role ?? '') == 'client' ? 'selected' : '' }}>Cliente</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Botón guardar -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-success px-4 shadow-sm">
                            <i class="fas fa-save me-2"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script de validación Bootstrap -->
@endsection
