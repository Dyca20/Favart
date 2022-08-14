<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoDeCompra extends Model
{
    use HasFactory;
    public $timestamps = false;

    
    protected $primaryKey = 'idCarrito';
    protected $fillable = [
        'idUsuario',
        'resumenPrecio',
        'total',
        'cantidad',
        'descuento',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
    }

    public function ProductoCompra()
    {
        return $this->hasOne(ProductoCompra::class, 'idCarrito', 'idCarrito');
    }

    public function CrearCarrito()
    {
        return true;
    }
}
