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

    <!-- Encabezado -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-3">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-user-friends mr-2 text-green-600"></i> Crear Referencia de Usuario
        </h1>
        <a href="{{ route('user_references.index') }}" 
           class="inline-flex items-center px-4 py-2 rounded-lg bg-white border border-gray-200 shadow-sm text-green-700 hover:bg-gray-100 transition">
            <i class="fas fa-arrow-left mr-2"></i> Volver al listado
        </a>
    </div>

    <!-- Card del formulario -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <div class="card-header bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3">
            <h6 class="m-0 font-semibold text-lg flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Datos de la Referencia
            </h6>
        </div>

        <div class="card-body bg-white p-4">
            <form action="{{ route('user_references.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-800 shadow-sm">
                        <ul class="mb-0 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Columna izquierda -->
                    <div class="space-y-3">
                        <div>
                            <label for="idUser" class="form-label font-medium">Usuario *</label>
                            <select name="idUser" id="idUser" class="form-select rounded-lg border-gray-300" required>
                                <option value="">Seleccionar usuario...</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">
                                        {{ $usuario->name }} {{ $usuario->firstLastName ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="phone" class="form-label font-medium">Teléfono</label>
                            <input type="text" name="phone" id="phone" class="form-control rounded-lg border-gray-300" value="{{ old('phone') }}">
                        </div>

                        <div>
                            <label for="contact_email" class="form-label font-medium">Correo de contacto</label>
                            <input type="email" name="contact_email" id="contact_email" class="form-control rounded-lg border-gray-300" value="{{ old('contact_email') }}">
                        </div>

                        <div>
                            <label for="whatsapp_link" class="form-label font-medium">Enlace de WhatsApp</label>
                            <input type="url" name="whatsapp_link" id="whatsapp_link" class="form-control rounded-lg border-gray-300" value="{{ old('whatsapp_link') }}">
                        </div>

                        <div>
                            <label for="facebook_link" class="form-label font-medium">Facebook</label>
                            <input type="url" name="facebook_link" id="facebook_link" class="form-control rounded-lg border-gray-300" value="{{ old('facebook_link') }}">
                        </div>
                    </div>

                    <!-- Columna derecha -->
                    <div class="space-y-3">
                        <div>
                            <label for="instagram_link" class="form-label font-medium">Instagram</label>
                            <input type="url" name="instagram_link" id="instagram_link" class="form-control rounded-lg border-gray-300" value="{{ old('instagram_link') }}">
                        </div>

                        <div>
                            <label for="youtube_link" class="form-label font-medium">YouTube</label>
                            <input type="url" name="youtube_link" id="youtube_link" class="form-control rounded-lg border-gray-300" value="{{ old('youtube_link') }}">
                        </div>

                        <div>
                            <label for="tiktok_link" class="form-label font-medium">TikTok</label>
                            <input type="url" name="tiktok_link" id="tiktok_link" class="form-control rounded-lg border-gray-300" value="{{ old('tiktok_link') }}">
                        </div>

                        <div>
                            <label for="qr_image" class="form-label font-medium">Código QR</label>
                            <input type="file" name="qr_image" id="qr_image" class="form-control rounded-lg border-gray-300">
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white shadow-sm transition">
                        <i class="fas fa-save mr-2"></i> Guardar Referencia
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
