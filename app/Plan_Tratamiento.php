<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan_Tratamiento extends Model
{
    
    public function odontogramas()
    {
        return $this->belongsToMany('App\Odontograma');
    }

    public function event()
    {
        return $this->belongsTo('App\Events', 'events_id');
    }

}
