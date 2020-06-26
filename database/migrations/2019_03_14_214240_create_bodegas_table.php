<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBodegasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodegas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',50)->nullable();
            $table->string('descripion',800)->nullable();
            $table->boolean('propio')->default(0)->nullable();
            $table->integer('provincia_id')->nullable(0);
            $table->integer('campo_id')->nullable(0);
            $table->string('direccion')->nullable();
            $table->integer('comuna_id')->nullable(0);
            $table->integer('bodega_id')->nullable(0);
            $table->integer('empresa_id')->nullable(0);
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
        Schema::dropIfExists('bodegas');
    }
}
