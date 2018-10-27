<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAnexo extends Model
{

    const ARCHIVO_NORMAL = 1;
    const ODONTOGRAMA = 2;

    protected $table = 'tipo_anexos';

    public function anexos()
    {
        return $this->hasMany('App\Anexo', 'tipoAnexoId');
    }
}
