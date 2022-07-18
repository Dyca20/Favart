<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id_Direccion';
    protected $fillable = [
        'señas_Exactas',
    ];

    public function persona()
    {
        return $this->hasOne(Persona::class, 'id_Direccion', 'id_Direccion');
    }


    public function Crear_Direccion()
    {
        return true;
    }
}
