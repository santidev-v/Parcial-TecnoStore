<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    protected $table = 'pedido';

    protected $fillable = [
        'cliente_id',
        'total',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(PedidoProducto::class, 'pedido_id');
    }

    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'pedido_producto', 'pedido_id', 'producto_id')
            ->withPivot(['cantidad', 'precio_unitario', 'subtotal'])
            ->withTimestamps();
    }
}
