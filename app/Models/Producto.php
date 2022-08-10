<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'cantidad',
        'cantidad_Carrito',
        'nombre_Producto',
        'precio',
        'imagen',
        'detalles',
        'categoria',
        'descuento',
    ];
    public function Crear_Producto()
    {
        return true;
    }

    public function Producto_Compra()
    {
        return $this->hasMany(Producto_Compra::class, 'id_producto', 'id_producto');
    }
    public function Producto_Historial()
    {
        return $this->hasMany(Producto_Historial::class, 'id_producto', 'id_producto');
    }

    public function Producto_Categoria()
    {
        return $this->hasMany(Producto_Categoria::class, 'id_producto', 'id_producto');
    }
}
