<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'Fecha_Pedido', 
        'Fecha_Entrega',
        'Estado',
    ];

    public function Crear_Pedido(){
        return true;
    }
}
