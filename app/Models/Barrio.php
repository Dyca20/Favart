<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id_Barrio',
        'id_Provincia', 
        'id_Canton', 
        'id_Distrito',
        'nombre',
    ];
    public function distrito(){
        return $this->hasOne(Distrito::class);
}
     public function Crear_Barrio(){
        return true;
    }
}
