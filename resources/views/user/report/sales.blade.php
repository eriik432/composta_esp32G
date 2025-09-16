@extends('user.dashboard')

@section('content')
<div id="layoutSidenav_content" class="p-6 bg-gray-50 min-h-screen">

    <!-- Título y botones -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-4xl font-extrabold text-gray-800">🛒 Reporte de Ventas</h1>
        <div class="flex gap-2">
            <button type="button" "
                    class="flex items-center gap-2 px-6 py-3 bg-red-600 text-white rounded-lg font-medium shadow-md hover:bg-red-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg><a href="{{route('historialV')}}">
                    Ver Historial</a>
                </button>
            <button type="button" id="btnDescargarPdf"
                class="flex items-center gap-2 px-6 py-3 bg-red-600 text-white rounded-lg font-medium shadow-md hover:bg-red-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Generar Reporte y Descargar PDF
            </button>
            <a href="{{ route('select') }}" 
               class="flex items-center gap-2 px-5 py-3 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium shadow-sm transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Volver
            </a>
        </div>
    </div>

    <!-- Filtros -->
    <form method="GET" action="{{ route('reportes.ventas') }}" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Filtrar por rango</label>
            <select name="rango" onchange="this.form.submit()" 
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <option value="">Todos</option>
                <option value="dia" @if(request('rango')=='dia') selected @endif>Hoy</option>
                <option value="semana" @if(request('rango')=='semana') selected @endif>Últimos 7 días</option>
                <option value="mes" @if(request('rango')=='mes') selected @endif>Últimos 30 días</option>
                <option value="ano" @if(request('rango')=='ano') selected @endif>Este Año</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de producto</label>
            <select name="tipo" onchange="this.form.submit()"
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <option value="">Todos</option>
                <option value="composta" @if(request('tipo')=='composta') selected @endif>Composta</option>
                <option value="humus" @if(request('tipo')=='humus') selected @endif>Humus</option>
                <option value="abono_organico" @if(request('tipo')=='abono_organico') selected @endif>Abono Orgánico</option>
            </select>
        </div>
    </form>

    <!-- Tabla de ventas -->
    @if ($ventas->count())
    <div class="overflow-x-auto shadow-lg rounded-lg bg-white mb-6">
        <table class="min-w-full divide-y divide-gray-200 table-auto">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="p-3 text-left">Fecha</th>
                    <th class="p-3 text-left">Cliente</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Detalles</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($ventas as $venta)
                <tr class="hover:bg-green-50 transition">
                    <td class="p-2">{{ $venta->created_at ?? '-' }}</td>
                    <td class="p-2">{{ $venta->client ? $venta->client->name : 'N/A' }}</td>
                    <td class="p-2">${{ number_format($venta->total, 2) }}</td>
                    <td class="p-2 text-left">
                        <ul class="list-disc list-inside text-gray-700">
                            @foreach ($venta->details as $detail)
                                @php
                                    $type = strtolower($detail->fertilizer->type ?? '');
                                @endphp
                                @if(empty(request('tipo')) || request('tipo') == $type)
                                    <li>
                                        {{ $detail->fertilizer->title ?? 'Sin producto' }} 
                                        ({{ $detail->amout }} unidades) - 
                                        ${{ number_format($detail->subtotal, 2) }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $ventas->withQueryString()->links() }}
    </div>

    @else
        <p class="text-center text-gray-500 mt-10 text-lg">No se encontraron ventas registradas.</p>
    @endif

</div>

<script>
document.getElementById('btnDescargarPdf').addEventListener('click', function () {
    const rango = document.querySelector('select[name="rango"]').value;
    const tipo = document.querySelector('select[name="tipo"]').value;

    let url = "{{ route('reports.download') }}";
    let params = [];

    if (rango) params.push(`rango=${encodeURIComponent(rango)}`);
    if (tipo) params.push(`tipo=${encodeURIComponent(tipo)}`);

    if (params.length > 0) {
        url += '?' + params.join('&');
    }

    window.location.href = url;
});
</script>
@endsection
