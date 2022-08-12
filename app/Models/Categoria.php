<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'idCategoria';
    protected $fillable = [
        'nombreCategoria',
    ];

    public function ProductoCategoria()
    {
        return $this->hasOne(ProductoCategoria::class, 'idCategoria', 'idCategoria');
    }

    public function CrearCategoria()
    {
        return true;
    }
}
