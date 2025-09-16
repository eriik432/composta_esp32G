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
                <i class="fas fa-file-invoice-dollar mr-2"></i> Editar Comprobante de Pago
            </h6>
            <a href="{{ route('change_plans.index') }}" 
               class="inline-flex items-center px-3 py-2 text-sm font-medium bg-white text-green-700 hover:bg-gray-100 rounded-lg shadow transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver al listado
            </a>
        </div>

        <!-- Body -->
        <div class="card-body bg-white p-4">
            <form action="{{ route('change_plans.update', $change_plan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Errores -->
                @if ($errors->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-800 shadow-sm">
                        <ul class="mb-0 pl-5 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Datos del usuario -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Usuario</label>
                    <div class="mt-1 p-2 border border-gray-200 bg-gray-50 rounded-lg text-gray-800 text-center font-medium">
                        {{ $change_plan->user->name }} {{ $change_plan->user->firstLastName }}
                    </div>
                </div>

                <!-- Observaciones -->
                <div class="mb-4">
                    <label for="observations" class="block text-sm font-medium text-gray-700">Observaciónes</label>
                    <textarea name="observations" id="observations" rows="4"
                              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-gray-800">{{ old('notes', $change_plan->observations) }}</textarea>
                </div>

                <!-- Estado -->
                <div class="mb-4">
                    <label for="state" class="block text-sm font-medium text-gray-700">Estado *</label>
                    <select id="state" name="state" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-gray-800">
                        <option value="">Seleccionar estado...</option>
                        <option value="0" {{ old('state', $change_plan->state) == 0 ? 'selected' : '' }}>Rechazado</option>
                        <option value="1" {{ old('state', $change_plan->state) == 1 ? 'selected' : '' }}>Pendiente</option>
                        <option value="2" {{ old('state', $change_plan->state) == 2 ? 'selected' : '' }}>Aprobado</option>
                    </select>
                </div>

                <!-- Imagen comprobante -->
                @if ($change_plan->image)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Comprobante</label>
                    <a href="{{ asset($change_plan->image) }}" target="_blank"
                       class="text-blue-600 hover:underline mt-1 inline-block">Ver imagen</a>
                </div>
                @endif

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
