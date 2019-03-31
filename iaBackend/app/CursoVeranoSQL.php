<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoVeranoSQL extends Model
{
    protected $table = 'cursoverano';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'rut',
        'email',
        'telefono'
    ];
}
