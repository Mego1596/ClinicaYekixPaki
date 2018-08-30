<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre1');
            $table->string('nombre2')->nullable()->default('N/A');
            $table->string('nombre3')->nullable()->default('N/A');
            $table->string('apellido1');
            $table->string('apellido2')->nullable()->default('N/A');
            $table->date('fechaNacimiento');
            $table->string('email')->unique()->nullable()->default('Sin correo electronico');
            $table->string('ocupacion');
            $table->string('telefono');
            $table->string('sexo',1);
            $table->string('domicilio');
            $table->string('responsable')->nullable()->default("Sin responsable");
            $table->string('direccion_de_trabajo')->nullable()->default("Sin direccion de trabajo");
            $table->string('expediente')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
