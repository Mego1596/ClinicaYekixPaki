<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOdontogramaPlanTratamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odontograma_plan__tratamiento', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('es_inicial');
            $table->integer('plan__tratamiento_id')->unsigned()->index();
            $table->foreign('plan__tratamiento_id')->references('id')->on('plan__tratamientos')->onDelete('cascade');
            $table->integer('odontograma_id')->unsigned()->index();
            $table->foreign('odontograma_id')->references('id')->on('odontogramas')->onDelete('cascade');
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
        Schema::dropIfExists('odontograma_plan_tratamiento');
    }
}
