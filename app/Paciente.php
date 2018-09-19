<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
      protected $fillable = [
      	//obligatorios
        'nombre1', 'nombre2', 'apellido1', 'apellido2', 
        'fechaNacimiento', 'email', 'ocupacion', 
        'domicilio', 'telefono', 'sexo', 
        //no obligatorios
        'responsable', 'direccion_de_trabajo','recomendado','historiaOdontologica'
    ];

    public function anexos()
    {
        return $this->hasMany('App\Anexo', 'pacienteId');
    }
}
