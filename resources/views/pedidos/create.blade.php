<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar pedido</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        .menu { display: flex; gap: 16px; margin-bottom: 16px; }
        .menu a { text-decoration: none; color: #1d4ed8; }
        table { border-collapse: collapse; width: 100%; margin-top: 12px; max-width: 900px; }
        th, td { border: 1px solid #e5e7eb; padding: 8px; text-align: left; }
        th { background: #f3f4f6; }
        label { display: block; margin-top: 12px; }
        select, input { width: 100%; max-width: 420px; padding: 8px; margin-top: 6px; box-sizing: border-box; }
        input.cantidad { max-width: 120px; margin-top: 0; }
        .actions { margin-top: 16px; display: flex; gap: 12px; }
        a { text-decoration: none; color: #1d4ed8; }
        button { padding: 8px 16px; }
        .error { color: #b91c1c; margin-top: 8px; font-size: 0.9em; }
        .notice { margin-top: 12px; }
    </style>
</head>
<body>
    <div class="menu">
        <a href="{{ route('productos.index') }}">Productos</a>
        <a href="{{ route('clientes.index') }}">Clientes</a>
        <a href="{{ route('pedidos.index') }}">Pedidos</a>
    </div>

    <h1>Registrar pedido</h1>

    @if ($clientes->isEmpty())
        <p class="notice">No hay clientes registrados. Registra un cliente primero en <a href="{{ route('clientes.create') }}">Clientes</a>.</p>
    @elseif ($productos->isEmpty())
        <p class="notice">No hay productos registrados. Registra un producto primero en <a href="{{ route('productos.create') }}">Productos</a>.</p>
    @else
        <form method="POST" action="{{ route('pedidos.store') }}">
            @csrf

            <label for="cliente_id">Cliente</label>
            <select id="cliente_id" name="cliente_id" required>
                <option value="">Selecciona un cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" @selected(old('cliente_id') == $cliente->id)>{{ $cliente->nombre }} ({{ $cliente->email }})</option>
                @endforeach
            </select>
            @error('cliente_id')
                <div class="error">{{ $message }}</div>
            @enderror

            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $index => $producto)
                        <tr>
                            <td>
                                {{ $producto->nombre }}
                                <input type="hidden" name="items[{{ $index }}][producto_id]" value="{{ $producto->id }}">
                            </td>
                            <td>{{ $producto->categoria }}</td>
                            <td>{{ number_format((float) $producto->precio, 2) }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>
                                <input class="cantidad" type="number" name="items[{{ $index }}][cantidad]" min="0" value="{{ old('items.' . $index . '.cantidad', 0) }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @error('items')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="actions">
                <button type="submit">Guardar pedido</button>
                <a href="{{ route('pedidos.index') }}">Ver listado</a>
            </div>
        </form>
    @endif
</body>
</html>
