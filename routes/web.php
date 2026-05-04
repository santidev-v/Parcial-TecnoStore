<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('productos.index');
});

Route::resource('productos', ProductoController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('pedidos', PedidoController::class);
