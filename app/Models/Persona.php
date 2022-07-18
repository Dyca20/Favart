<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id_Persona';
    protected $fillable = [
        'id_Direccion',
        'nombre',
        'apellidos',
        'edad',
    ];
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id_Persona', 'id_Persona');
    }
    public function Crear_Cliente()
    {
        return true;
    }
    public function telefono()
    {
        return $this->hasOne(Telefono::class, 'id_Persona', 'id_Persona');
    }
}
