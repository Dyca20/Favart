<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'idPedido';
    protected $fillable = [
        'idUsuario',
        'idHistorial',
        'fecha',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }
    public function HistorialCarrito()
    {
        return $this->belongsTo(HistorialCarrito::class, 'idHistorial', 'idHistorial');
    }
    public function factura()
    {
        return $this->hasOne(CarritoDeCompra::class, 'idPedido', 'idPedido');
    }
    public function Crear_Pedido()
    {
        return true;
    }
}
