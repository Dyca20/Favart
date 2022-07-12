<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id_Factura',
        'id_Pedido', 
        'fecha',
        'medio_Pago',
        'resumen',
    ];
    public function pedido(){
        return $this->hasOne(Pedido::class);
}

     public function Crear_Factura(){
        return true;
    }
}
