<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envios extends Model
{
    protected $table='envios';

    protected $primaryKey='id_envio';

    public $timestamps=false;

    protected $fillable=[
        'lugar_envio',
        'calle',
        'comuna',
        'ciudad',
        'condicion'
    ];

    protected $guarded=[

    ];
}
