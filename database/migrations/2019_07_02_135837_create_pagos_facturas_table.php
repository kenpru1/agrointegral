<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factura_id')->unsigned();
            $table->integer('tipo_pago_id')->unsigned();
            $table->timestamp('fecha')->nullable();
            $table->string('numero')->nullable();
            $table->string('transmisor')->nullable();
            $table->string('comentarios')->nullable();
            $table->double('pago')->default(0)->nullable();
            $table->double('abono')->default(0)->nullable();
            $table->double('deuda')->default(0)->nullable();
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
        Schema::dropIfExists('pagos_facturas');
    }
}
