<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantencionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion',200)->nullable();
            $table->string('observaciones',800)->nullable();
            $table->timestamp('fecha')->nullable();
            $table->double('costo');
            $table->double('iva');
            $table->double('total_iva');
            $table->integer('maquinaria_id');
            $table->integer('cliente_proveedor_id');
            $table->integer('factura_recibida_id');
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
        Schema::dropIfExists('mantenciones');
    }
}
