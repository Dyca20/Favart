<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'cantidad',
        'nombre',
        'precio',
        'imagen',
        'detalles',
        'categoria',
    ];
    public function Crear_Producto()
    {
        return true;
    }

    public function Producto_Compra()
    {
        return $this->belongsToMany(Producto::class, 'id_producto', 'id_producto');
    }
}
