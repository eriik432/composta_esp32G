@extends('admin.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-4 bg-gray-50 min-h-screen">

    <!-- Alertas -->
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-800 shadow-sm flex items-center">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Encabezado -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-3">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-users mr-2 text-green-600"></i> Gestión de Referencias de Usuario
        </h1>
        <a href="{{ route('user_references.create') }}" 
           class="inline-flex items-center px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white shadow-sm transition">
            <i class="fas fa-plus-circle mr-2"></i> Nueva Referencia
        </a>
    </div>

    <!-- Card Tabla -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <div class="card-header bg-gradient-to-r from-green-500 to-emerald-600 text-white flex justify-between items-center">
            <h6 class="m-0 font-semibold flex items-center">
                <i class="fas fa-list mr-2"></i> Listado de Referencias
            </h6>
            <span class="px-3 py-1 rounded-full bg-white text-green-700 font-semibold shadow-sm">
                Total: {{ $references->total() }}
            </span>
        </div>

        <div class="card-body bg-white p-4">
            <div class="overflow-x-auto">
                <table class="table table-hover text-sm align-middle min-w-full">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Usuario</th>
                            <th class="px-3 py-2">Teléfono</th>
                            <th class="px-3 py-2">Redes Sociales</th>
                            <th class="px-3 py-2">QR</th>
                            <th class="px-3 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = ($references->currentPage()-1) * $references->perPage() + 1; @endphp
                        @forelse ($references as $ref)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-2">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-800 text-white">{{ $i++ }}</span>
                                </td>
                                <td class="px-3 py-2 font-semibold text-gray-800">{{ $ref->user->name ?? '—' }}</td>
                                <td class="px-3 py-2">{{ $ref->phone ?? '—' }}</td>
                                <td class="px-3 py-2 space-y-1 text-left">
                                    @if ($ref->whatsapp_link)
                                        <a href="{{ $ref->whatsapp_link }}" target="_blank" 
                                           class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded shadow-sm text-xs">
                                            <i class="fab fa-whatsapp mr-1"></i> WhatsApp
                                        </a><br>
                                    @endif
                                    @if ($ref->facebook_link)
                                        <a href="{{ $ref->facebook_link }}" target="_blank" 
                                           class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded shadow-sm text-xs">
                                            <i class="fab fa-facebook mr-1"></i> Facebook
                                        </a><br>
                                    @endif
                                    @if ($ref->instagram_link)
                                        <a href="{{ $ref->instagram_link }}" target="_blank" 
                                           class="inline-flex items-center px-2 py-1 bg-pink-100 text-pink-600 rounded shadow-sm text-xs">
                                            <i class="fab fa-instagram mr-1"></i> Instagram
                                        </a><br>
                                    @endif
                                    @if ($ref->tiktok_link)
                                        <a href="{{ $ref->tiktok_link }}" target="_blank" 
                                           class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-800 rounded shadow-sm text-xs">
                                            <i class="fab fa-tiktok mr-1"></i> TikTok
                                        </a>
                                    @endif
                                    @if (!$ref->whatsapp_link && !$ref->facebook_link && !$ref->instagram_link && !$ref->tiktok_link)
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    @if ($ref->qr_image)
                                        <a href="{{ asset($ref->qr_image) }}" target="_blank" 
                                           class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded shadow-sm text-xs">
                                            <i class="fas fa-qrcode mr-1"></i> Ver QR
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">Sin imagen</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <a href="{{ route('user_references.edit', $ref->id) }}" 
                                       class="inline-flex items-center px-2 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded shadow-sm text-xs">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-4">
                                    <i class="fas fa-info-circle mr-1"></i> No hay referencias registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-4 flex justify-center">
                {{ $references->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

</div>
@endsection
