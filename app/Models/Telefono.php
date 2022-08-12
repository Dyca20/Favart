<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'idTelefono';
    protected $fillable = [
        
        'numeroTelefono', 
        'idPersona', 
    ];
   
    public function Persona(){
        return $this->belongsTo(Persona::class,'idPersona','idPersona');
    }
    
    public function CrearTelefono(){
        return true;
    }
}

