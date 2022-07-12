<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    public $timestamps = false;
 
    protected $fillable = [
        'Id_Usuario', 
        'Nombre',
        'Primer_Apellido',
        'Segundo_Apelido',
        'Edad',
        'Id_Barrio',
        'Id_Distrito',
        'Id_Canton',
        'Id_Provincia',
        'Señas_Exactas',
    ];
    public function usuario(){
        return $this->hasOne(Usuario::class);
}
    public function Crear_Cliente(){
        return true;
    }

}
