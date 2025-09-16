<table>
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
            <td>{{ $r->total }}</td>
            <td>{{ $r->details }}</td>
        </tr>
        @endforeach
    </tbody>
</table>