<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fecha')->nullable();
            $table->integer('factura_id')->nullable()->unsigned();
            $table->integer('tipo_operacion_id')->nullable();
            $table->integer('tipo_movimiento_id')->nullable();
            $table->string('tipo_entrada',20)->nullable();
            $table->integer('stock_id')->nullable();
            $table->double('cantidad')->nullable();
            $table->integer('cliente_proveedor_id')->nullable();
            $table->integer('producto_id')->nullable()->unsigned();
            $table->integer('guia_despacho_id')->nullable()->unsigned();
            $table->integer('actividad_id')->nullable()->unsigned();
            $table->integer('user_id')->nullable();
            $table->string('comentarios',800)->nullable();
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
        Schema::dropIfExists('movimientos');
    }
}
