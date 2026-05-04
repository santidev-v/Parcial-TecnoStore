<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de clientes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        .menu { display: flex; gap: 16px; margin-bottom: 16px; }
        .menu a { text-decoration: none; color: #1d4ed8; }
        table { border-collapse: collapse; width: 100%; margin-top: 12px; }
        th, td { border: 1px solid #e5e7eb; padding: 8px; text-align: left; }
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

    <h1>Listado de clientes</h1>

    <div class="actions">
        <a href="{{ route('clientes.create') }}">Registrar cliente</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Creado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay clientes registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
