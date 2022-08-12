<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'idPersona';
    protected $fillable = [
        'idDireccion',
        'nombre',
        'apellidos',
        'edad',
    ];
    public function User()
    {
        return $this->hasOne(User::class, 'idPersona', 'idPersona');
    }
    public function CrearPersona()
    {
        return true;
    }
    public function Telefono()
    {
        return $this->hasOne(Telefono::class, 'idPersona', 'idPersona');
    }
    public function Direccion()
    {
        return $this->belongsTo(Direccion::class, 'idDireccion', 'idDireccion');
    }
}
