<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabricas extends Model
{
    protected $table='fabricas';

    protected $primaryKey='id_fabrica';

    public $timestamps=false;

    protected $fillable=[
        'nombre',
        'telefono',
        'condicion'
    ];

    protected $guarded=[

    ];
}
