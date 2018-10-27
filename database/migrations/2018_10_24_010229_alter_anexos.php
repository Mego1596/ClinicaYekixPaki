<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\TipoAnexo;

class AlterAnexos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anexos', function (Blueprint $table) {
            $table->integer('tipoAnexoId')->unsigned()->default(TipoAnexo::ARCHIVO_NORMAL);
            $table->foreign('tipoAnexoId')->references('id')->on('tipo_anexos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anexos', function (Blueprint $table) {
            $table->dropColumn(['tipoAnexoId']);
        });
    }
}
