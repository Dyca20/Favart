<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'idProductoCategoria';
    protected $fillable = [
        'idCategoria',
        'idProducto',
    ];
    public function Categoria()
    {
        return $this->belongsTo(Categoria::class, 'idCategoria', 'idCategoria');
    }
    public function Producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto', 'idProducto');
    }

    public function CrearProductoCategoria()
    {
        return true;
    }
}
