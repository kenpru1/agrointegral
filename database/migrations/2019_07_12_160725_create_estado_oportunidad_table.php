<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoOportunidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_oportunidad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50)->nullable();
            $table->string('class', 30)->nullable();
            $table->string('class_tablero', 30)->nullable();
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
        Schema::dropIfExists('estado_oportunidad');
    }
}
