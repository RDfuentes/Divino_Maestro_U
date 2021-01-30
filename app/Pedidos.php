<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table='pedidos';

    protected $primaryKey='id_pedido';

    public $timestamps=false;

    protected $fillable=[
        'id_cliente',
        'id_envio',
        'fecha',
        'id_articulo',
        'descripcion',
        'cantidad',
        'condicion'
    ];

    protected $guarded=[

    ];
}
