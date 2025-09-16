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

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-gradient-primary text-dark">
                <h5 class="m-0 fw-bold">
                    <i class="fas fa-user-edit me-2"></i>Editar Referencia de Usuario
                </h5>
                <a href="{{ route('user_references.index') }}" class="btn btn-light btn-sm shadow-sm">
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

                <form action="{{ route('user_references.update', $user_reference->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <!-- Usuario (solo visualización) -->
                        <div class="col-12">
                            <label class="form-label fw-bold">Usuario:</label>
                            <div class="form-control-plaintext border rounded px-3 py-2 bg-light">
                                <i class="fas fa-user me-2 text-primary"></i>
                                {{ $user_reference->user->name }} {{ $user_reference->user->firstLastName ?? '' }}
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Teléfono <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    value="{{ old('phone', $user_reference->phone) }}" placeholder="Ej: +591 77777777">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="contact_email" class="form-label">Correo de contacto</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="contact_email" id="contact_email" class="form-control"
                                    value="{{ old('contact_email', $user_reference->contact_email) }}" placeholder="correo@ejemplo.com">
                            </div>
                        </div>

                        <!-- Redes sociales -->
                        <div class="col-md-6">
                            <label for="whatsapp_link" class="form-label">WhatsApp</label>
                            <input type="url" name="whatsapp_link" id="whatsapp_link" class="form-control"
                                value="{{ old('whatsapp_link', $user_reference->whatsapp_link) }}" placeholder="https://wa.me/...">

                            <label for="facebook_link" class="form-label mt-3">Facebook</label>
                            <input type="url" name="facebook_link" id="facebook_link" class="form-control"
                                value="{{ old('facebook_link', $user_reference->facebook_link) }}" placeholder="https://facebook.com/...">

                            <label for="instagram_link" class="form-label mt-3">Instagram</label>
                            <input type="url" name="instagram_link" id="instagram_link" class="form-control"
                                value="{{ old('instagram_link', $user_reference->instagram_link) }}" placeholder="https://instagram.com/...">
                        </div>

                        <div class="col-md-6">
                            <label for="youtube_link" class="form-label">YouTube</label>
                            <input type="url" name="youtube_link" id="youtube_link" class="form-control"
                                value="{{ old('youtube_link', $user_reference->youtube_link) }}" placeholder="https://youtube.com/...">

                            <label for="tiktok_link" class="form-label mt-3">TikTok</label>
                            <input type="url" name="tiktok_link" id="tiktok_link" class="form-control"
                                value="{{ old('tiktok_link', $user_reference->tiktok_link) }}" placeholder="https://tiktok.com/...">

                            <label for="qr_image" class="form-label mt-3">Código QR (opcional)</label>
                            <input type="file" name="qr_image" id="qr_image" class="form-control">

                            @if ($user_reference->qr_image)
                                <div class="mt-2">
                                    <label class="form-label">QR actual:</label><br>
                                    <img src="{{ asset('storage/' . $user_reference->qr_image) }}" 
                                        alt="QR actual" class="img-thumbnail shadow-sm" width="120">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Botón guardar -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-success px-4 shadow-sm">
                            <i class="fas fa-save me-2"></i>Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
