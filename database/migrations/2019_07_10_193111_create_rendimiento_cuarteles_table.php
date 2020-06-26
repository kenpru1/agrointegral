<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRendimientoCuartelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendimiento_cuarteles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cuartel_id')->nullable()->unsigned();
            $table->integer('empresa_id')->nullable()->unsigned();
            $table->string('fecha_año',20)->nullable();
            $table->double('toneladas_brutas');
            $table->double('produccion');
            $table->double('descarte_bruto');
            $table->double('total_produccion');
            $table->double('exportacion');
            $table->double('descarte_produccion');
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
        Schema::dropIfExists('rendimiento_cuarteles');
    }
}
