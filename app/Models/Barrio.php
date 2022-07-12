<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'Id_Provincia', 
        'Id_Canton', 
        'Id_Distrito',
        'Nombre',
    ];
    public function distrito(){
        return $this->hasOne(Distrito::class);
}
     public function Crear_Barrio(){
        return true;
    }
}
