<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_del_Pedido extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'Id_Producto', 
        'Resumen_Precio',
        'Cantidad',
    ];
    public function producto(){
        return $this->hasOne(Producto::class);
}
    public function Crear_Detalles_Del_Pedido(){
        return true;
    }

}
