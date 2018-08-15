<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event_name');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('textcolor',255)->default('#FFFFFF');
            $table->string('descripcion',255)->nullable();
            $table->timestamps();
            $table->integer('procedimiento_id')->unsigned();
            $table->foreign('procedimiento_id')->references('id')->on('procedimientos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
