<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'Nombre_Producto', 
        'Precio_Unidad',
        'Accesorio',
    ];
    public function Crear_Producto(){
        return true;
    }
}
