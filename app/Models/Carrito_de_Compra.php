<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito_de_Compra extends Model
{
    use HasFactory;
    public $timestamps = false;

    
    protected $primaryKey = 'id_Carrito';
    protected $fillable = [
        'id_Usuario',
        'resumen_Precio',
        'cantidad',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_Usuario', 'id_Usuario');
    }

    public function producto_compra()
    {
        return $this->hasOne(Producto_Compra::class, 'id_Carrito', 'id_Persona');
    }

    public function pedido()
    {
        return $this->hasOne(Pedido::class, 'id_Carrito', 'id_Carrito');
    }
    public function Crear_Carrito()
    {
        return true;
    }
}
