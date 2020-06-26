<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id')->nullable()->unsigned();
            $table->integer('tipo_racion_id')->nullable()->unsigned();
            $table->string('nombre',100)->nullable();
            $table->string('descripcion',800)->nullable();
            $table->timestamps('fecha')->nullable();
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
        Schema::dropIfExists('raciones');
    }
}
