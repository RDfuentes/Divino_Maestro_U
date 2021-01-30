<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table='clientes';

    protected $primaryKey='id_cliente';

    public $timestamps=false;

    protected $fillable=[
        'codigo_unico',
        'nombre',
        'apellido',
        'id_envio',
        'saldo',
        'credito',
        'descuento',
        'condicion'
    ];

    protected $guarded=[

    ];
}
