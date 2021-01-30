<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $table='articulos';

    protected $primaryKey='id_articulo';

    public $timestamps=false;

    protected $fillable=[
        'articulo',
        'id_fabrica',
        'existencia',
        'descripcion',
        'condicion'
    ];

    protected $guarded=[

    ];
}
