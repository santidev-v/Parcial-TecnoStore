<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('id', 'desc')->get();

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => ['required', 'string', 'max:255'],
            'nombre' => ['required', 'string', 'max:255'],
            'categoria' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        Producto::create($validated);

        return redirect()->route('productos.index');
    }

    public function show(Producto $producto)
    {
        return redirect()->route('productos.index');
    }

    public function edit(Producto $producto)
    {
        return redirect()->route('productos.index');
    }

    public function update(Request $request, Producto $producto)
    {
        return redirect()->route('productos.index');
    }

    public function destroy(Producto $producto)
    {
        return redirect()->route('productos.index');
    }
}
