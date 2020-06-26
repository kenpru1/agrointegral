<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasRecibidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas_recibidas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empresa_id')->nullable()->unsigned();
            $table->string('ref', 50)->nullable();
            $table->string('ref_vendedor', 50)->nullable();
            $table->timestamps('fecha_emision')->nullable();
            $table->timestamps('fecha_vence')->nullable();
            $table->integer('cliente_proveedor_id')->nullable()->unsigned();
            $table->integer('comuna_id')->nullable()->unsigned();
            $table->string('codigo_postal', 50)->nullable();
            $table->integer('tipo_pago_id')->nullable()->unsigned();
            $table->double('monto_neto')->nullable();
            $table->double('porcentaje_iva')->nullable();
            $table->double('iva')->nullable();
            $table->double('total')->nullable();
            $table->boolean('excenta')->default(0)->nullable();
            $table->integer('estado_factura_id')->nullable()->unsigned();
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
        Schema::dropIfExists('facturas_recibidas');
    }
}
