<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'Id_Pedido', 
        'Fecha',
        'Medio_Pago',
        'Cantidad',
        'Resumen',
    ];
    public function pedido(){
        return $this->hasOne(Pedido::class);
}

     public function Crear_Factura(){
        return true;
    }
}
