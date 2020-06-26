<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOportunidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oportunidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empresa_id')->nullable()->unsigned();
            $table->integer('cliente_proveedor_id')->nullable()->unsigned();
            $table->integer('empresa_contacto_id')->nullable()->unsigned();
            $table->string('titulo', 100)->nullable();
            $table->bigInteger('monto')->nullable();
            $table->timestamps('fecha_cierre')->nullable();
            $table->integer('estado_oportunidad_id')->nullable()->unsigned();
            $table->integer('etapa_oportunidad_id')->nullable()->unsigned();
            $table->string('motivo_perdida', 100)->nullable();
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
        Schema::dropIfExists('oportunidades');
    }
}
