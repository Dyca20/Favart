<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'id_Factura';
    protected $fillable = [
        'id_Pedido',
        'fecha',
        'medio_Pago',
        'resumen',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_Pedido', 'id_Pedido');
    }

    public function Crear_Factura()
    {
        return true;
    }
}
