<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'Nombre',
    ];

    public function Crear_Provincia(){
        return true;
    }

    
}
