<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'idFactura';
    protected $fillable = [
        'idPedido',
        'fecha',
        'medioPago',
        'resumen',
    ];

    public function Pedido()
    {
        return $this->belongsTo(Pedido::class, 'idPedido', 'idPedido');
    }

    public function CrearFactura()
    {
        return true;
    }
}
