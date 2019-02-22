<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Odontograma extends Model
{
    protected $table = 'odontogramas';

    public function planTratamientos()
    {
        return $this->belongsToMany('App\Plan_Tratamiento');
    }

}
