<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePresupuestoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_presupuesto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('presupuesto_id')->nullable()->unsigned();
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
        Schema::dropIfExists('detalle_presupuesto');
    }
}
