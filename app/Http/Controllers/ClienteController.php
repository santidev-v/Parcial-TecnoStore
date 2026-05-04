<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'desc')->get();

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:cliente,email'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'direccion' => ['nullable', 'string', 'max:255'],
        ]);

        Cliente::create($validated);

        return redirect()->route('clientes.index');
    }

    public function show(Cliente $cliente)
    {
        return redirect()->route('clientes.index');
    }

    public function edit(Cliente $cliente)
    {
        return redirect()->route('clientes.index');
    }

    public function update(Request $request, Cliente $cliente)
    {
        return redirect()->route('clientes.index');
    }

    public function destroy(Cliente $cliente)
    {
        return redirect()->route('clientes.index');
    }
}
