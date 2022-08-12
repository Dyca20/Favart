<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCompra extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'idCarritoProducto';
    protected $fillable = [
        'idCarrito',
        'idProducto',
        'cantidadCarrito',
    ];
    public function CarritoDeCompra()
    {
        return $this->belongsTo(CarritoDeCompra::class, 'idCarrito', 'idCarrito');
    }
    public function Producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto', 'idProducto');
    }

    public function CrearProductoCompra()
    {
        return true;
    }
}
