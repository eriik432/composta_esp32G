<h3>Ventas por cliente ({{ $from }} a {{ $to }})</h3>
<table width="100%" cellspacing="0" cellpadding="6" border="1">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Total</th>
            <th>Detalles</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $r)
        <tr>
            <td>{{ $r->client_name }}</td>
            <td>${{ number_format($r->total, 2) }}</td>
            <td>{{ $r->details }}</td>
        </tr>
        @endforeach
    </tbody>
</table>