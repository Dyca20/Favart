<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_Historial extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id_producto_historial';
    protected $fillable = [
        'id_historial',
        'id_producto',
        'cantidad_Carrito',
    ];
    public function Producto_Historial()
    {
        return $this->belongsTo(Producto_Historial::class, 'id_historial', 'id_historial');
    }
    public function Producto()
    {
        return $this->belongsTo(Producto::class, 'id_Producto', 'id_Producto');
    }
    public function Crear_Producto_Historial()
    {
        return true;
    }
}
