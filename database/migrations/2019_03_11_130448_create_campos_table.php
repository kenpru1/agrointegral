<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCamposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->boolean('propio')->default(0)->nullable();
            $table->integer('provincia_id')->nullable(0);
            $table->integer('comuna_id')->nullable(0);
            $table->integer('trabajador_id')->nullable(0)->unsigned();;
            $table->string('descripcion',800)->nullable();
            $table->integer('empresa_id')->nullable(0);
            $table->double('tamanno', 15, 8)->nullable(0);
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
        Schema::dropIfExists('campos');
    }
}
