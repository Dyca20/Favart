<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_Compra extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id_Carrito_Producto';
    protected $fillable = [
        'id_Carrito',
        'id_Producto',
    ];
    public function Carrito_de_Compra()
    {
        return $this->belongsTo(Carrito_de_Compra::class, 'id_Carrito', 'id_Carrito');
    }
    public function Producto()
    {
        return $this->belongsTo(Producto::class, 'id_Producto', 'id_Producto');
    }

    public function Crear_Producto_Compra()
    {
        return true;
    }
}
