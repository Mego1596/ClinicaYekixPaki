<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'color',
    ];
}
