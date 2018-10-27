<?php

use Illuminate\Database\Seeder;

use App\TipoAnexo;

class TipoAnexoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $archivos = new TipoAnexo();
        $odontograma = new TipoAnexo();

        $archivos->tipoAnexo = "Archivos Anexados";
        $odontograma->tipoAnexo = "Odontograma";

        $archivos->save();
        $odontograma->save();
    }
}
