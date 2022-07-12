<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id_Producto',
        'cantidad',
        'nombre', 
        'precio',
        'imagen',
        'detalles',
        'categoria',
    ];
    public function Crear_Producto(){
        return true;
    }
}
