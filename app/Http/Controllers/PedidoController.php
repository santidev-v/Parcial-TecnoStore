<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoProducto;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['cliente', 'detalles.producto'])
            ->orderBy('id', 'desc')
            ->get();

        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $productos = Producto::orderBy('nombre')->get();

        return view('pedidos.create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => ['required', 'exists:cliente,id'],
            'items' => ['required', 'array'],
            'items.*.producto_id' => ['required', 'integer', 'exists:producto,id'],
            'items.*.cantidad' => ['required', 'integer', 'min:0'],
        ]);

        $lineas = [];

        foreach ($validated['items'] as $item) {
            $productoId = (int) $item['producto_id'];
            $cantidad = (int) $item['cantidad'];

            if ($cantidad <= 0) {
                continue;
            }

            if (! array_key_exists($productoId, $lineas)) {
                $lineas[$productoId] = 0;
            }

            $lineas[$productoId] += $cantidad;
        }

        if (count($lineas) === 0) {
            return back()
                ->withErrors(['items' => 'Debes ingresar al menos un producto con cantidad mayor a cero.'])
                ->withInput();
        }

        $productos = Producto::whereIn('id', array_keys($lineas))
            ->get()
            ->keyBy('id');

        foreach ($lineas as $productoId => $cantidad) {
            $producto = $productos->get($productoId);

            if (! $producto) {
                return back()
                    ->withErrors(['items' => 'Hay productos invalidos en el pedido.'])
                    ->withInput();
            }

            if ((int) $producto->stock < $cantidad) {
                return back()
                    ->withErrors(['items' => 'Stock insuficiente para ' . $producto->nombre . '.'])
                    ->withInput();
            }
        }

        DB::transaction(function () use ($validated, $lineas, $productos): void {
            $pedido = Pedido::create([
                'cliente_id' => (int) $validated['cliente_id'],
                'total' => 0,
            ]);

            $total = 0;

            foreach ($lineas as $productoId => $cantidad) {
                $producto = $productos->get($productoId);
                $precioUnitario = (float) $producto->precio;
                $subtotal = round($precioUnitario * $cantidad, 2);

                PedidoProducto::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precioUnitario,
                    'subtotal' => $subtotal,
                ]);

                $producto->decrement('stock', $cantidad);
                $total += $subtotal;
            }

            $pedido->update([
                'total' => round($total, 2),
            ]);
        });

        return redirect()->route('pedidos.index');
    }

    public function show(Pedido $pedido)
    {
        return redirect()->route('pedidos.index');
    }

    public function edit(Pedido $pedido)
    {
        return redirect()->route('pedidos.index');
    }

    public function update(Request $request, Pedido $pedido)
    {
        return redirect()->route('pedidos.index');
    }

    public function destroy(Pedido $pedido)
    {
        return redirect()->route('pedidos.index');
    }
}
