<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrabajadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',100)->nullable();
            $table->string('rut',100)->nullable();
            $table->integer('tipo_trabajador_id')->nullable(0);
            $table->integer('nivel_calificacion_id')->nullable(0);
            $table->boolean('asesor')->default(0)->nullable();
            $table->string('email',100)->nullable();
            $table->string('telefono',50)->nullable();
            $table->string('direccion',100)->nullable();
            $table->integer('provincia_id')->nullable(0);
            $table->integer('comuna_id')->nullable(0);
            $table->string('codigo_postal',20)->nullable();
            $table->string('nacionalidad',50)->nullable();
            $table->string('comentarios')->nullable();
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
        Schema::dropIfExists('trabajadores');
    }
}
