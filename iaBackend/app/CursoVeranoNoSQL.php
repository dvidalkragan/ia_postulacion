<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class CursoVeranoNoSQL extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'suscriptores';
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'rut',
    ];
}
