<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadGastoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_gasto', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('actividad_id')->nullable()->unsigned();
            $table->timestamps('fecha')->nullable();
            $table->string('periodo', 20)->nullable();
            $table->string('nro_factura', 50)->nullable();
            $table->string('nro_comprobante', 50)->nullable();
            $table->integer('cliente_proveedor_id')->nullable()->unsigned();
            $table->string('rut', 20)->nullable();
            $table->string('descripcion', 500)->nullable();
            $table->double('neto')->nullable();
            $table->double('porc_iva')->nullable();
            $table->double('iva')->nullable();
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
        Schema::dropIfExists('actividad_gasto');
    }
}
