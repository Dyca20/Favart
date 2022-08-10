<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id_Pedido';
    protected $fillable = [
        'id_Usuario',
        'id_historial',
        'fecha',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'id_Usuario', 'id_Usuario');
    }
    public function Historial_Carrito()
    {
        return $this->belongsTo(Historial_Carrito::class, 'id_historial', 'id_historial');
    }
    public function factura()
    {
        return $this->hasOne(Carrito_de_Compra::class, 'id_Pedido', 'id_Pedido');
    }
    public function Crear_Pedido()
    {
        return true;
    }
}
