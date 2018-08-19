<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
      protected $fillable = [
        'nombre1', 'nombre2', 'apellido1', 'apellido2', 
        'fechaNacimiento', 'ocupacion', 'responsable', 
        'direccion_de_trabajo', 'domicilio', 'telefono', 'sexo'
    ];
}
