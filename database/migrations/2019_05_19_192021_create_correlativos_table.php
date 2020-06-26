<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorrelativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correlativos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('presupuesto')->nullable(0);
            $table->integer('factura')->nullable(0);
            $table->integer('comprobante')->nullable(0);
            $table->integer('nota_credito')->nullable(0);
            $table->integer('guia_despacho')->nullable(0);
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
        Schema::dropIfExists('correlattivos');
    }
}
