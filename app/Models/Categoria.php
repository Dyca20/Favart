<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id_categoria';
    protected $fillable = [
        'nombreCategoria',
    ];

    public function Producto_Categoria()
    {
        return $this->hasOne(Producto_Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function Crear_Categoria()
    {
        return true;
    }
}
