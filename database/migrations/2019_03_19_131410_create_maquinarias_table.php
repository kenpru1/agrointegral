<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaquinariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinarias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',100)->nullable();
            $table->string('descripcion',100)->nullable();
            $table->integer('maquinaria_tipo_id')->nullable();
            $table->string('marca',100)->nullable();
            $table->string('patente',20)->nullable();
            $table->string('modelo',100)->nullable();
            $table->string('propietario',50)->nullable();
            $table->timestamp('fecha_compra')->nullable();
            $table->double('valor_compra')->nullable();
            $table->timestamp('fecha_inspeccion')->nullable();
            $table->timestamp('fecha_seguro')->nullable();
            $table->timestamp('venc_rev_tecnica')->nullable();
            $table->string('numero_roma',100)->nullable();
            $table->integer('empresa_id')->nullable();
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
        Schema::dropIfExists('maquinarias');
    }
}
