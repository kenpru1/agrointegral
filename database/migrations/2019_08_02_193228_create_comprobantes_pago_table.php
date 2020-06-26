<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprobantesPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobantes_pago', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trabajador_id');
            $table->string('numero')->nullable();
            $table->timestamps('fecha_pago');
            $table->double('total')->default(0)->nullable();
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
        Schema::dropIfExists('comprobantes_pago');
    }
}
