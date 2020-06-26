<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo',50)->nullable();
            $table->double('precio')->nullable();
            $table->string('descripcion',800)->nullable();
            $table->boolean('clasificacion')->default(0)->nullable();
            $table->integer('producto_id')->nullable()->unsigned();
            $table->integer('tipo_actividad_id')->nullable()->unsigned();
            $table->string('otro',800)->nullable();
            $table->integer('anno_fabricacion')->nullable()->unsigned();
            $table->string('modelo',200)->nullable();
            $table->integer('comuna_id')->nullable()->unsigned();
            $table->integer('provincia_id')->nullable()->unsigned();
            $table->string('cantidad',100)->nullable();
            $table->integer('tipo_envio_id')->nullable()->unsigned();
            $table->string('orden_minima',100)->nullable();
            $table->integer('estado_publicacion_id')->nullable()->unsigned();
            $table->string('contacto',200)->nullable();
            $table->string('telefono',20)->nullable();
            $table->string('email',100)->nullable();
            $table->integer('empresa_id')->nullable()->unsigned();
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
        Schema::dropIfExists('publicaciones');
    }
}
