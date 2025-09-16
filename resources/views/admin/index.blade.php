@extends('admin.dashboard')

@section('content')
 <div id="layoutSidenav_content">
       @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif      
    <!-- Encabezado -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Usuarios</h1>
        <button id="addUserBtn" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle fa-sm text-white-50"></i> Nuevo Usuario
        </button>
    </div>

    <!-- Formulario (oculto inicialmente) -->
    <div id="userFormContainer" class="card shadow mb-4 d-none">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold" id="formTitle">Agregar Usuario</h6>
        </div>
        <div class="card-body">
            <form id="userForm">
                <input type="hidden" id="userId">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password">
                        <small class="text-muted">Dejar en blanco para no cambiar</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="userType" class="form-label">Tipo de Usuario</label>
                        <select class="form-control" id="userType" required>
                            <option value="admin">Administrador</option>
                            <option value="user">Usuario</option>
                            <option value="client">Cliente</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" id="cancelFormBtn" class="btn btn-secondary mr-2">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="saveUserBtn">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Usuarios -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary">Listado de Usuarios</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="usersTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php $i = 1 @endphp
                        @foreach($user as $user)
                            <tr>
                                <td>{{ $i++ }}</td> <!-- Contador incremental -->
                                <td>{{ $user->name }} @php" "@endphp {{ $user->firstLastNamename }}@php" "@endphp {{ $user->secondLastNamename }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @switch($user->role)
                                        @case('admin')
                                            <span class="badge badge-danger">Administrador</span>
                                            @break
                                        @case('user')
                                            <span class="badge badge-primary">Usuario</span>
                                            @break
                                        @case('client')
                                            <span class="badge badge-success">Cliente</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-circle btn-warning edit-user" data-id="{{ $user->id }}">
                                       <a href="{{ route('admins.edit', $user) }}"><i class="fas fa-edit"></i></a> 
                                    </button>
                                    <form action="{{ route('admins.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar usuario?')"></button>
                        
                                    <button class="btn btn-sm btn-circle btn-danger delete-user">
                                        <i class="fas fa-trash"></i>
                                    </button></form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
            
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mostrar formulario para nuevo usuario
    document.getElementById('addUserBtn').addEventListener('click', function() {
        document.getElementById('userFormContainer').classList.remove('d-none');
        document.getElementById('formTitle').textContent = 'Agregar Usuario';
        document.getElementById('userForm').reset();
        document.getElementById('userId').value = '';
        document.getElementById('password').required = true;
    });

    // Cancelar formulario
    document.getElementById('cancelFormBtn').addEventListener('click', function() {
        document.getElementById('userFormContainer').classList.add('d-none');
    });

    // Editar usuario
    document.querySelectorAll('.edit-user').forEach(btn => {
        btn.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            
            // Aquí iría tu llamada AJAX para obtener los datos del usuario
            fetch(`/admin/users/${userId}`)
                .then(response => response.json())
                .then(user => {
                    document.getElementById('userId').value = user.id;
                    document.getElementById('name').value = user.name;
                    document.getElementById('email').value = user.email;
                    document.getElementById('userType').value = user.role;
                    document.getElementById('password').required = false;
                    
                    document.getElementById('formTitle').textContent = 'Editar Usuario';
                    document.getElementById('userFormContainer').classList.remove('d-none');
                });
        });
    });

    // Eliminar usuario
    document.querySelectorAll('.delete-user').forEach(btn => {
        btn.addEventListener('click', function() {
            if(confirm('¿Estás seguro de eliminar este usuario?')) {
                const userId = this.getAttribute('data-id');
                
                // Aquí iría tu llamada AJAX para eliminar el usuario
                fetch(`/admin/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    if(response.ok) {
                        location.reload();
                    }
                });
            }
        });
    });

    // Guardar usuario
    document.getElementById('userForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const userId = document.getElementById('userId').value;
        const url = userId ? `/admin/users/${userId}` : '/admin/users';
        const method = userId ? 'PUT' : 'POST';
        
        const userData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            role: document.getElementById('userType').value
        };
        
        const password = document.getElementById('password').value;
        if(password) userData.password = password;
        
        fetch(url, {
            method: method,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(userData)
        }).then(response => {
            if(response.ok) {
                location.reload();
            }
        });
    });
});
</script>

@endsection