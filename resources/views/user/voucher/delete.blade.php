@extends('user.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-6">

    <!-- Título y botones -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">🛑 Gestión de Comprobantes Rechazados</h1>

        <div class="flex gap-2">
            <a href="{{ route('deployC') }}" 
               class="text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Volver
            </a>
        </div>
    </div>

    <!-- Tabla de Comprobantes -->
    @if ($vouchers->count())
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto text-sm text-center border">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="p-2">Nro</th>
                    <th class="p-2">Cliente</th>
                    <th class="p-2">Producto</th>
                    <th class="p-2">Descripción</th>
                    <th class="p-2">Tipo</th>
                    <th class="p-2">Precio Unitario</th>
                    <th class="p-2">Cantidad</th>
                    <th class="p-2">Total</th>
                    <th class="p-2">Imagen</th>
                    <th class="p-2">Observaciones</th>
                    <th class="p-2">Estado</th>
                    <th class="p-2">Fecha de Envío</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @php $i = 1 @endphp
                @forelse ($vouchers as $voucher)
                <tr class="hover:bg-gray-50">
                    <td class="p-2">{{ $i++ }}</td>
                    <td class="p-2">{{ $voucher->user->name ?? 'N/A' }}</td>
                    <td class="p-2">{{ $voucher->product->title ?? 'N/A' }}</td>
                    <td class="p-2">{{ $voucher->product->description ?? 'N/A' }}</td>
                    <td class="p-2">{{ $voucher->product->type ?? 'N/A' }}</td>
                    <td class="p-2">${{ number_format($voucher->subtotal, 2) ?? 'N/A' }}</td>
                    <td class="p-2">{{ $voucher->amount }}</td>
                    <td class="p-2">${{ number_format(($voucher->subtotal * $voucher->amount), 2) ?? 'N/A' }}</td>
                    <td class="p-2">
                        @if ($voucher->image)
                        <a href="{{ asset('storage/' . $voucher->image) }}" target="_blank" class="text-red-600 underline">
                            Ver imagen
                        </a>
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td class="p-2">{{ $voucher->observations ?? '—' }}</td>
                    <td class="p-2">
                        @switch($voucher->state)
                            @case(0)
                                <span class="badge bg-yellow-400 text-black">Rechazado</span>
                            @break
                            @case(1)
                                <span class="badge bg-red-600 text-white">Pendiente</span>
                            @break
                            @case(2)
                                <span class="badge bg-green-600 text-white">Aprobado</span>
                            @break
                        @endswitch
                    </td>
                    <td class="p-2">{{ $voucher->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-2">
                        <a href="{{ route('editVoucher', $voucher->id) }}" 
                           class="px-2 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-xs">
                           Actualizar
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="13" class="text-center py-4 text-gray-600">No hay comprobantes disponibles.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $vouchers->links() }}
        </div>
    </div>

    @else
        <p class="text-center text-gray-600 mt-8">No hay comprobantes disponibles.</p>
    @endif
</div>
@endsection
