<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $timestamps = false;
 
    protected $fillable = [
        'id_Direccion', 
        'id_Persona',
        'nombre',
        'primer_Apellido',
        'segundo_Apelido',
        'edad',
    ];
    public function usuario(){
        return $this->hasOne(Usuario::class);
}
    public function Crear_Cliente(){
        return true;
    }

}
