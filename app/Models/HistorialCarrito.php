<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialCarrito extends Model
{
    use HasFactory;
    public $timestamps = false;

    
    protected $primaryKey = 'idHistorial';
    protected $fillable = [
        'idUsuario',
        'resumenPrecio',
        'total',
        'cantidad',
        'descuento',
        'fecha',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }

    public function ProductoHistorial()
    {
        return $this->hasOne(ProductoHistorial::class, 'idHistorial', 'idHistorial');
    }

    public function Pedido()
    {
        return $this->hasOne(Pedido::class, 'idHistorial', 'idHistorial');
    }
    public function CrearHistorialCarrito()
    {
        return true;
    }
}
