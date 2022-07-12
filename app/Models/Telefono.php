<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id_Telefono',
        'numero_Telefono', 
        'id_Persona', 
    ];
    public function Crear_Telefono(){
        return true;
    }
}

