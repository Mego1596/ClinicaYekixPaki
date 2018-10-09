<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan__tratamientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('procedimiento_id')->nullable()->unsigned();
            $table->foreign('procedimiento_id')->references('id')->on('procedimientos')->nullable();
            $table->integer('events_id')->nullable()->unsigned();
            $table->foreign('events_id')->references('id')->on('events')->onDelete('cascade');
            $table->integer('referencia')->nullable()->unsigned();
            $table->foreign('referencia')->references('id')->on('plan__tratamientos')->onDelete('cascade');
            $table->integer('no_de_piezas')->unsigned();
            $table->double('honorarios', 5, 2);
            $table->boolean('activo');
            $table->boolean('completo');
            $table->boolean('en_proceso');
            $table->boolean('no_iniciado');
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
        Schema::dropIfExists('plan__tratamientos');
    }
}
