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
                <i class="fas fa-edit mr-2"></i> Actualizar Plan de Usuario
            </h6>
            <a href="{{ route('user_plans.index') }}" 
               class="inline-flex items-center px-3 py-2 text-sm font-medium bg-white text-green-700 hover:bg-gray-100 rounded-lg shadow transition">
                <i class="fas fa-arrow-left mr-2"></i> Volver al listado
            </a>
        </div>

        <!-- Body -->
        <div class="card-body bg-white p-4">
            <form action="{{ route('user_plans.update', $userPlan->id) }}" method="POST">
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

                <!-- Usuario -->
                <div class="mb-4 text-center">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Usuario</label>
                    <div class="p-2 border border-gray-200 bg-gray-50 rounded-lg text-gray-800">
                        {{ $userPlan->user->name }} {{ $userPlan->user->firstLastName }}
                    </div>
                </div>

                <div class="row gap-4">
                    <!-- Selección de Plan -->
                    <div class="col-md-6 mb-4">
                        <label for="plan_id" class="block text-sm font-medium text-gray-700 mb-1">Plan asignado</label>
                        <select name="plan_id" id="plan_id" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-gray-800">
                            <option value="">Seleccionar plan...</option>
                            @foreach ($planes as $plan)
                                <option value="{{ $plan->id }}"
                                    {{ old('plan_id', $userPlan->plan_id) == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }} ({{ $plan->cost }} USD, {{ $plan->duration }} días)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Estado activo/inactivo -->
                    <div class="col-md-6 mb-4">
                        <label for="active" class="block text-sm font-medium text-gray-700 mb-1">Estado del plan</label>
                        <select name="active" id="active" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-gray-800">
                            <option value="">Seleccionar estado...</option>
                            <option value="1" {{ old('active', $userPlan->active) == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('active', $userPlan->active) == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
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
