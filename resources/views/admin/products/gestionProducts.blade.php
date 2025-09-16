@extends('admin.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-4 bg-gray-50 min-h-screen">

    <!-- ✅ Alertas -->
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-800 shadow-sm flex items-center">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- ✅ Encabezado -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-3">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-box mr-2 text-green-600"></i> Gestión de Productos de Abono
        </h1>
        <div class="flex gap-2 flex-wrap">
            <a href="{{ route('products.create') }}" 
               class="inline-flex items-center px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white shadow-sm transition">
                <i class="fas fa-plus-circle mr-2"></i> Nuevo Producto
            </a>
            <a href="{{ route('products.delete') }}" 
               class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-600 hover:bg-gray-700 text-white shadow-sm transition">
                <i class="fas fa-trash-restore-alt mr-2"></i> Ver Eliminados
            </a>
        </div>
    </div>

    <!-- ✅ Card Tabla -->
    <div class="card border-0 shadow-lg rounded-2xl overflow-hidden">
        <div class="card-header bg-gradient-to-r from-green-500 to-emerald-600 text-white flex justify-between items-center">
            <h6 class="m-0 font-semibold flex items-center">
                <i class="fas fa-list mr-2"></i> Listado de Productos Disponibles
            </h6>
            <span class="px-3 py-1 rounded-full bg-white text-green-700 font-semibold shadow-sm">
                Total: {{ $productos->total() }}
            </span>
        </div>

        <div class="card-body bg-white p-4">
            <div class="overflow-x-auto">
                <table class="table table-hover text-sm align-middle min-w-full">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-3 py-2">#</th>
                            <th class="px-3 py-2">Título</th>
                            <th class="px-3 py-2">Tipo</th>
                            <th class="px-3 py-2 text-right">Precio</th>
                            <th class="px-3 py-2 text-right">Cantidad (kg)</th>
                            <th class="px-3 py-2">Usuario</th>
                            <th class="px-3 py-2">Fecha</th>
                            <th class="px-3 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = ($productos->currentPage()-1) * $productos->perPage() + 1; @endphp
                        @forelse ($productos as $producto)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 py-2">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-800 text-white">{{ $i++ }}</span>
                                </td>
                                <td class="px-3 py-2 font-semibold text-gray-800">{{ $producto->title }}</td>
                                <td class="px-3 py-2">
                                    <span class="px-2 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-semibold">
                                        {{ ucfirst(str_replace('_', ' ', $producto->type)) }}
                                    </span>
                                </td>
                                <td class="px-3 py-2 text-right">${{ number_format($producto->price, 2) }}</td>
                                <td class="px-3 py-2 text-right">{{ $producto->amount }}</td>
                                <td class="px-3 py-2">{{ $producto->user->name }} {{ $producto->user->firstLastName }}</td>
                                <td class="px-3 py-2">{{ \Carbon\Carbon::parse($producto->created_at)->format('d/m/Y H:i') }}</td>
                                <td class="px-3 py-2 text-center space-x-1">
                                    <a href="{{ route('products.edit', $producto->id) }}" 
                                       class="inline-flex items-center px-2 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded shadow-sm text-xs" 
                                       title="Editar">
                                       <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $producto->id) }}" method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('¿Desactivar este producto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded shadow-sm text-xs" 
                                                title="Desactivar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-gray-500 py-4">
                                    <i class="fas fa-box-open mr-1"></i> No hay productos disponibles.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- ✅ Paginación -->
            <div class="mt-4 flex justify-center">
                {{ $productos->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
