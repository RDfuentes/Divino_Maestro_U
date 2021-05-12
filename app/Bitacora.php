<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table='bitacora_articulos';

    protected $primaryKey='id_bitacora';

    public $timestamps=false;

    protected $fillable=[
        'id_articulo',
        'fecha',
        'ejecutor',
        'actividad_realizada',
        'informacion_actual',
        'informacion_anterior'
    ];

    protected $guarded=[

    ];
}
