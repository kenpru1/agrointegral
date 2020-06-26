<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('caravana',20);
            $table->string('nombre',50);
            $table->integer('especie_id')->nullable()->unsigned();
            $table->string('raza',100)->nullable();
            $table->string('categoria_pedigree',100)->nullable();
            $table->integer('sexo_id')->nullable()->unsigned();
            $table->timestamp('fecha_nacimiento')->nullable();
            $table->double('peso_nacer')->nullable();
            $table->string('caravana_madre',20)->nullable();
            $table->string('nombre_madre',50)->nullable();
            $table->string('caravana_progenitor',20)->nullable();
            $table->string('nombre_progenitor',50)->nullable();
            $table->double('indice_corporal')->nullable();
            $table->integer('rodeo_id')->nullable()->unsigned();
            $table->string('observaciones',800)->nullable();
            $table->string('codigo_rfid',20)->nullable();
            $table->timestamp('fecha_muerte')->nullable();
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
        Schema::dropIfExists('animales');
    }
}
