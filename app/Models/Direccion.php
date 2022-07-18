<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id_Direccion',
        'señas_Exactas',
    ];
    public function Direccion(){
        return $this->hasOne(Pedido::class);
}

     public function Crear_Direccion(){
        return true;
    }
}
