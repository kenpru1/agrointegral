<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('rut_dni')->nullable();
            $table->string('direccion')->nullable();
            $table->string('comuna')->nullable();
            $table->string('ciudad')->nullable();
            $table->integer('pais_id')->default(0);
            $table->string('codigo_postal')->nullable();
            $table->integer('plan_id')->nullable(0);
            $table->string('facturacion',2)->nullable();
            $table->string('giro',200)->nullable();
            $table->boolean('email_facturacion')->default(0)->nullable();
            $table->string('logo',200)->nullable();
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
        Schema::dropIfExists('companies');
    }
}
