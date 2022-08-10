<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial_Carrito extends Model
{
    use HasFactory;
    public $timestamps = false;

    
    protected $primaryKey = 'id_historial';
    protected $fillable = [
        'id_Usuario',
        'resumen_Precio',
        'total',
        'cantidad',
        'descuento',
        'fecha',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_Usuario', 'id_Usuario');
    }

    public function Producto_Historial()
    {
        return $this->hasOne(Producto_Historial::class, 'id_historial', 'id_historial');
    }

    public function pedido()
    {
        return $this->hasOne(Pedido::class, 'id_historial', 'id_historial');
    }
    public function Crear_Historial_Carrito()
    {
        return true;
    }
}
