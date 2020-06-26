<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanitariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanitarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('labor_id')->nullable()->unsigned();
            $table->timestamps('fecha_inicio')->nullable();
            $table->timestamps('fecha_termino')->nullable();
            $table->integer('tipo_sanitario_id')->nullable()->unsigned();
            $table->string('nombre',100)->nullable();
            $table->string('tratamiento_utilizado',400)->nullable();
            $table->string('dias',100)->nullable();
            $table->string('comentario',800)->nullable();
            $table->integer('trabajador_id')->nullable()->unsigned();
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
        Schema::dropIfExists('sanitarios');
    }
}
