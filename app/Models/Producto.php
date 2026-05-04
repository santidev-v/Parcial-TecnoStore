<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    protected $table = 'producto';

    protected $fillable = [
        'codigo',
        'nombre',
        'categoria',
        'precio',
        'stock',
    ];

    public function detallesPedido(): HasMany
    {
        return $this->hasMany(PedidoProducto::class, 'producto_id');
    }

    public function pedidos(): BelongsToMany
    {
        return $this->belongsToMany(Pedido::class, 'pedido_producto', 'producto_id', 'pedido_id')
            ->withPivot(['cantidad', 'precio_unitario', 'subtotal'])
            ->withTimestamps();
    }
}
