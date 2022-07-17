<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id_Telefono';
    protected $fillable = [
        
        'numero_Telefono', 
        'id_Persona', 
    ];
   
    public function persona(){
        return $this->belongsTo(Persona::class,'id_Persona','id_Persona');
    }
    
    public function Crear_Telefono(){
        return true;
    }
}

