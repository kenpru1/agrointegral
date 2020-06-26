<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuartelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuarteles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->boolean('propio')->default(0)->nullable();
            $table->boolean('productivo')->default(0)->nullable();
            $table->integer('provincia_id')->nullable(0);
            $table->integer('comuna_id')->nullable(0);
            $table->string('descripcion',800)->nullable();
            $table->double('tamanno', 15, 8);
            $table->integer('campo_id')->nullable(0);
            $table->integer('tipo_cultivo_id')->nullable(0);
            $table->string('coordenadas',100)->nullable();
            $table->string('ubiq_lat',100)->nullable();
            $table->string('ubiq_lng',100)->nullable();
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
        Schema::dropIfExists('cuarteles');
    }
}
