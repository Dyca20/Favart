<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'idDireccion';
    protected $fillable = [
        'señasExactas',
    ];

    public function Persona()
    {
        return $this->hasOne(Persona::class, 'idDireccion', 'idDireccion');
    }


    public function CrearDireccion()
    {
        return true;
    }
}
