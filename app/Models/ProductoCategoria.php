<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id_producto_categoria';
    protected $fillable = [
        'id_categoria',
        'id_producto',
    ];
    public function Categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }
    public function Producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    public function Crear_ProductoCategoria()
    {
        return true;
    }
}
