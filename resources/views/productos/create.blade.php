<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar producto</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
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
    <h1>Registrar producto</h1>

    <form method="POST" action="{{ route('productos.store') }}">
        @csrf

        <label for="codigo">Codigo</label>
        <input id="codigo" name="codigo" type="text" value="{{ old('codigo') }}" required>
        @error('codigo')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="nombre">Nombre</label>
        <input id="nombre" name="nombre" type="text" value="{{ old('nombre') }}" required>
        @error('nombre')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="categoria">Categoria</label>
        <input id="categoria" name="categoria" type="text" value="{{ old('categoria') }}" required>
        @error('categoria')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="precio">Precio</label>
        <input id="precio" name="precio" type="number" step="0.01" min="0" value="{{ old('precio') }}" required>
        @error('precio')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="stock">Stock</label>
        <input id="stock" name="stock" type="number" min="0" value="{{ old('stock') }}" required>
        @error('stock')
            <div class="error">{{ $message }}</div>
        @enderror

        <div class="actions">
            <button type="submit">Guardar</button>
            <a href="{{ route('productos.index') }}">Ver listado</a>
        </div>
    </form>
</body>
</html>
