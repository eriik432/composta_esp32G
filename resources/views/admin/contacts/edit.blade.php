@extends('admin.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-4 bg-gray-50 min-h-screen">

    <!-- Alertas -->
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-800 shadow-sm">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-800 shadow-sm">
            <i class="fas fa-times-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Card -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <!-- Header -->
        <div class="card-header bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-semibold text-lg flex items-center">
                <i class="fas fa-edit mr-2"></i> Editar Estado del Mensaje
            </h6>
            <a href="{{ route('contacts.index') }}" 
               class="inline-flex items-center px-3 py-2 text-sm font-medium bg-white text-green-700 hover:bg-gray-100 rounded-lg shadow transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver al listado
            </a>
        </div>

        <!-- Body -->
        <div class="card-body bg-white p-4">
            <form action="{{ route('contacts.update', $message->id) }}" method="POST">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-800 shadow-sm">
                        <ul class="mb-0 pl-5 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Datos del mensaje -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="block text-sm font-medium text-gray-700">Nombre completo</label>
                        <div class="mt-1 p-2 border border-gray-200 bg-gray-50 rounded-lg text-gray-800">
                            {{ $message->full_name }}
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1 p-2 border border-gray-200 bg-gray-50 rounded-lg text-green-700">
                            {{ $message->email }}
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Asunto</label>
                    <div class="mt-1 p-2 border border-gray-200 bg-gray-50 rounded-lg text-gray-800">
                        {{ $message->subject }}
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Mensaje</label>
                    <div class="mt-1 p-3 border border-gray-200 bg-gray-50 rounded-lg text-gray-600">
                        {{ $message->message }}
                    </div>
                </div>

                <!-- Estado -->
                <div class="mb-4">
                    <label for="state" class="block text-sm font-medium text-gray-700">Estado *</label>
                    <select id="state" name="state" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-gray-800">
                        <option value="">Seleccionar estado...</option>
                        <option value="0" {{ old('state', $message->state) == 0 ? 'selected' : '' }}>Recepcionado</option>
                        <option value="1" {{ old('state', $message->state) == 1 ? 'selected' : '' }}>Pendiente</option>
                    </select>
                </div>

                <!-- Botón -->
                <div class="text-end mt-5">
                    <button type="submit" 
                        class="inline-flex items-center px-5 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition">
                        <i class="fas fa-save mr-2"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
