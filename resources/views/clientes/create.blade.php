<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar cliente</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        .menu { display: flex; gap: 16px; margin-bottom: 16px; }
        .menu a { text-decoration: none; color: #1d4ed8; }
        form { max-width: 520px; }
        label { display: block; margin-top: 12px; }
        input { width: 100%; padding: 8px; margin-top: 6px; box-sizing: border-box; }
        .actions { margin-top: 16px; display: flex; gap: 12px; }
        a { text-decoration: none; color: #1d4ed8; }
        button { padding: 8px 16px; }
        .error { color: #b91c1c; margin-top: 4px; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="menu">
        <a href="{{ route('productos.index') }}">Productos</a>
        <a href="{{ route('clientes.index') }}">Clientes</a>
        <a href="{{ route('pedidos.index') }}">Pedidos</a>
    </div>

    <h1>Registrar cliente</h1>

    <form method="POST" action="{{ route('clientes.store') }}">
        @csrf

        <label for="nombre">Nombre</label>
        <input id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" required>
        @error('nombre')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="telefono">Telefono</label>
        <input id="telefono" name="telefono" type="text" value="{{ old('telefono') }}">
        @error('telefono')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="direccion">Direccion</label>
        <input id="direccion" name="direccion" type="text" value="{{ old('direccion') }}">
        @error('direccion')
            <div class="error">{{ $message }}</div>
        @enderror

        <div class="actions">
            <button type="submit">Guardar</button>
            <a href="{{ route('clientes.index') }}">Ver listado</a>
        </div>
    </form>
</body>
</html>
