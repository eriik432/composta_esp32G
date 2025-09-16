@extends('user.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-6">

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Encabezado y botones -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">💳 Gestión de Comprobantes de Pago</h1>
        <div class="flex gap-2">
            <a href="{{ route('deleteC') }}" 
               class="flex items-center gap-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg shadow-sm text-gray-700 font-medium transition">
                <i class="fas fa-trash-restore-alt"></i> Comprobantes Rechazados
            </a>
        </div>
    </div>

    <!-- Tabla de Vouchers -->
    @if($vouchers->count())
    <div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full table-auto text-sm divide-y divide-gray-200">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="p-2 text-left">#</th>
                    <th class="p-2 text-left">Cliente</th>
                    <th class="p-2 text-left">Producto</th>
                    <th class="p-2 text-left">Descripción</th>
                    <th class="p-2 text-left">Tipo</th>
                    <th class="p-2 text-left">Precio Unitario</th>
                    <th class="p-2 text-left">Cantidad</th>
                    <th class="p-2 text-left">Total</th>
                    <th class="p-2 text-left">Imagen</th>
                    <th class="p-2 text-left">Observaciones</th>
                    <th class="p-2 text-left">Estado</th>
                    <th class="p-2 text-left">Fecha de Envío</th>
                    <th class="p-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @php $i = 1; @endphp
                @foreach($vouchers as $voucher)
                <tr class="hover:bg-green-50 transition">
                    <td class="p-2">{{ $i++ }}</td>
                    <td class="p-2">{{ $voucher->client->name ?? 'N/A' }} {{ $voucher->client->firstLastName ?? '' }}</td>
                    <td class="p-2">{{ $voucher->product->title ?? 'N/A' }}</td>
                    <td class="p-2">{{ $voucher->product->description ?? 'N/A' }}</td>
                    <td class="p-2">{{ $voucher->product->type ?? 'N/A' }}</td>
                    <td class="p-2">${{ number_format($voucher->subtotal ?? 0, 2) }}</td>
                    <td class="p-2">{{ $voucher->amount ?? 0 }}</td>
                    <td class="p-2">${{ number_format(($voucher->subtotal ?? 0) * ($voucher->amount ?? 0), 2) }}</td>
                    <td class="p-2">
                        @if ($voucher->image)
                            <a href="{{ asset($voucher->image) }}" target="_blank" 
                               class="text-red-600 hover:underline">Ver imagen</a>
                        @else
                            <span class="text-gray-400">Sin imagen</span>
                        @endif
                    </td>
                    <td class="p-2">{{ $voucher->observations ?? '—' }}</td>
                    <td class="p-2">
                        @switch($voucher->state)
                            @case(0)
                                <span class="px-2 py-1 rounded-full bg-yellow-200 text-yellow-800 text-sm font-medium">Rechazado</span>
                            @break
                            @case(1)
                                <span class="px-2 py-1 rounded-full bg-red-200 text-red-800 text-sm font-medium">Pendiente</span>
                            @break
                            @case(2)
                                <span class="px-2 py-1 rounded-full bg-green-200 text-green-800 text-sm font-medium">Aprobado</span>
                            @break
                        @endswitch
                    </td>
                    <td class="p-2">{{ $voucher->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-2">
                        <a href="{{ route('editVoucher', $voucher->id) }}" 
                           class="flex items-center gap-2 px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg text-sm transition">
                            <i class="fas fa-edit"></i> Actualizar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $vouchers->links() }}
    </div>
    @else
        <p class="text-center text-gray-500 mt-10 text-lg">No hay comprobantes disponibles.</p>
    @endif

</div>
@endsection
