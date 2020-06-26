<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalisisSueloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis_suelo', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fecha');
            $table->integer('unidad_id')->nullable(0);
            $table->integer('cuartel_id')->nullable(0);
            $table->double('prof_desde')->nullable();
            $table->double('prof_hasta')->nullable();
            $table->string('sector',100)->nullable();
            $table->double('ph')->nullable();
            $table->double('n')->nullable();
            $table->double('p')->nullable();
            $table->double('k')->nullable();
            $table->double('s')->nullable();
            $table->double('mg')->nullable();
            $table->double('na')->nullable();
            $table->double('ca')->nullable();
            $table->double('c')->nullable();
            $table->double('nitro_organico')->nullable();
            $table->double('no3')->nullable();
            $table->double('rel_cn')->nullable();
            $table->double('mat_organica')->nullable();
            $table->string('arcilla',100)->nullable();
            $table->string('arena',100)->nullable();
            $table->string('limo',100)->nullable();
            $table->double('cond_electrica')->nullable();
            $table->double('humedad')->nullable();
            $table->string('observaciones',800)->nullable();
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
        Schema::dropIfExists('analisis_suelo');
    }
}
