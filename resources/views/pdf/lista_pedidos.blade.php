<style>
    table{
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 8px 12px;
        text-align: left;
    }
</style>

<h1>Lista Pedidos</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>FECHA</th>
            <th>ESTADO</th>
            <th>CLIENTE ID</th>
            <th>USER ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $pedido)
        <tr>
            <td>{{ $pedido->id }}</td>
            <td>{{ $pedido->fecha }}</td>
            <td>{{ $pedido->estado }}</td>
            <td>{{ $pedido->cliente_id }}</td>
            <td>{{ $pedido->user_id }}</td>
        </tr>
        @endforeach
    </tbody>

</table>