<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de pedidos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        .menu { display: flex; gap: 16px; margin-bottom: 16px; }
        .menu a { text-decoration: none; color: #1d4ed8; }
        table { border-collapse: collapse; width: 100%; margin-top: 12px; }
        th, td { border: 1px solid #e5e7eb; padding: 8px; text-align: left; vertical-align: top; }
        th { background: #f3f4f6; }
        .actions { margin-bottom: 12px; }
        a { text-decoration: none; color: #1d4ed8; }
    </style>
</head>
<body>
    <div class="menu">
        <a href="{{ route('productos.index') }}">Productos</a>
        <a href="{{ route('clientes.index') }}">Clientes</a>
        <a href="{{ route('pedidos.index') }}">Pedidos</a>
    </div>

    <h1>Listado de pedidos</h1>

    <div class="actions">
        <a href="{{ route('pedidos.create') }}">Registrar pedido</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Detalle</th>
                <th>Total</th>
                <th>Creado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->cliente?->nombre }}</td>
                    <td>
                        @foreach ($pedido->detalles as $detalle)
                            <div>{{ $detalle->cantidad }} x {{ $detalle->producto?->nombre }} = {{ number_format((float) $detalle->subtotal, 2) }}</div>
                        @endforeach
                    </td>
                    <td>{{ number_format((float) $pedido->total, 2) }}</td>
                    <td>{{ $pedido->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay pedidos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
