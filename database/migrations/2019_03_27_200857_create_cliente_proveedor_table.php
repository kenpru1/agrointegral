<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClienteProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_proveedor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_razon',100)->nullable();
            $table->string('rut',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('telefono',50)->nullable();
            $table->string('direccion',100)->nullable();
            $table->string('codigo_postal',50)->nullable();
            $table->string('web',100)->nullable();
            $table->boolean('proveedor')->default(0)->nullable();
            $table->boolean('cliente')->default(0)->nullable();
            $table->integer('provincia_id')->nullable(0);
            $table->integer('comuna_id')->nullable(0);
            $table->integer('pais_id')->nullable(0);
            $table->integer('empresa_id')->nullable(0);
            $table->string('observacion',200)->nullable();
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
        Schema::dropIfExists('cliente_proveedor');
    }
}
