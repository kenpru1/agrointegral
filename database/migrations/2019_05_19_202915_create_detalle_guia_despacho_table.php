<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleGuiaDespachoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_guia_despacho', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guia_despacho_id')->nullable()->unsigned();
            $table->integer('producto_id')->nullable()->unsigned();
            $table->double('cantidad')->nullable();
            $table->double('precio_venta')->nullable();
            $table->string('desc_libre',100)->nullable();
            $table->double('total')->nullable();
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
        Schema::dropIfExists('detalle_guia_despacho');
    }
}
