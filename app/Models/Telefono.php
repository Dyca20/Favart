<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'Numero_Telefono', 
        'Id_Cliente', 
    ];
    public function Crear_Telefono(){
        return true;
    }
}

