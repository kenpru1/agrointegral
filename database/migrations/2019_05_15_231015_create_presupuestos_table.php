<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero',50)->nullable();
            $table->timestamp('fecha')->nullable();
            $table->integer('cliente_id')->nullable()->unsigned();
            $table->integer('validez')->nullable();
            $table->integer('condicion_pago_id')->nullable()->unsigned();
            $table->integer('tipo_pago_id')->nullable()->unsigned();
            $table->integer('fuente_id')->nullable()->unsigned();
            $table->timestamp('fecha_entrega')->nullable();
            $table->string('nota_publica',100)->nullable();
            $table->string('nota_privada',100)->nullable();
            $table->double('sub_total');
            $table->double('porcentaje_descuento');
            $table->double('porcentaje_iva');
            $table->double('iva');
            $table->double('descuento');
            $table->double('total');
            $table->integer('estado_presupuesto_id')->nullable()->unsigned();
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
        Schema::dropIfExists('presupuestos');
    }
}
