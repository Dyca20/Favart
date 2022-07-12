<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'Nombre_Usuario', 
        'Contraseña',
        'Fecha_Registro',
        'Email',
    ];

    public function Crear_Usuario(){
        return true;
    }
}

