<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuiaDespachosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guia_despachos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero',50)->nullable();
            $table->timestamp('fecha')->nullable();
            $table->integer('cliente_id')->nullable()->unsigned();
            $table->string('nota_publica',100)->nullable();
            $table->string('nota_privada',100)->nullable();
            $table->double('porcentaje_iva');
            $table->double('iva');
            $table->double('sub_total');
            $table->double('total');
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
        Schema::dropIfExists('guia_despachos');
    }
}
