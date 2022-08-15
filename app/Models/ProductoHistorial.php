<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoHistorial extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'idProductoHistorial';
    protected $fillable = [
        'idHistorial',
        'idProducto',
        'cantidadCarrito',
        'descuento'
    ];
    public function ProductoHistorial()
    {
        return $this->belongsTo(Producto_Historial::class, 'idHistorial', 'idHistorial');
    }
    public function Producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto', 'idProducto');
    }
    public function CrearProductoHistorial()
    {
        return true;
    }
}
