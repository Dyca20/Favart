<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'idProducto';

    protected $fillable = [
        'cantidad',
        'cantidadCarrito',
        'nombreProducto',
        'precio',
        'imagen',
        'detalles',
        'categoria',
        'descuento',
    ];
    public function CrearProducto()
    {
        return true;
    }
    public function ProductoCompra()
    {
        return $this->hasMany(ProductoCompra::class, 'idProducto', 'idProducto');
    }
    public function ProductoHistorial()
    {
        return $this->hasMany(ProductoHistorial::class, 'idProducto', 'idProducto');
    }
    public function ProductoCategoria()
    {
        return $this->hasMany(Producto_Categoria::class, 'idProducto', 'idProducto');
    }
}
