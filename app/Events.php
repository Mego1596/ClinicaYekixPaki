<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
        'event_name', 'start_date', 'end_date'
    ];

    public function plan_tratamientos()
    {
        return $this->hasMany('App\Plan_Tratamiento');
    }

    public function paciente()
    {
        return $this->belongsTo('App\Paciente');
    }

}
