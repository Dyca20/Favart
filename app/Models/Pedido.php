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
        'id_Carrito',
        'fecha',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'id_Usuario', 'id_Usuario');
    }
    public function carrito_de_compra()
    {
        return $this->belongsTo(Carrito_de_Compra::class, 'id_Carrito', 'id_Carrito');
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
