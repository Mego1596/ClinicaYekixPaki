<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleReceta extends Model
{
    protected $fillable = [
        'receta_id', 'medicamento','dosis','cantidad',
    ];
}
