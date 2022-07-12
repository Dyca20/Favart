<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'Id_Provincia', 
        'Nombre',
    ];
    public function provincia(){
        return $this->hasOne(Provincia::class);
}
     public function Crear_Canton(){
        return true;
    }
}
