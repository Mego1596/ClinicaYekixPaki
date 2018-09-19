<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    protected $table = 'anexos';

    public function paciente()
    {
        return $this->belongsTo('App\Paciente', 'pacienteId');
    }
}
