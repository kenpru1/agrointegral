<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',100)->nullable();
            $table->string('numero_inscripcion',50)->nullable();
            $table->integer('unidad_id')->nullable(0);
            $table->string('composicion',200)->nullable();
            $table->integer('cliente_proveedor_id')->nullable(0);
            $table->string('ficha_tecnica',100)->nullable();
            $table->integer('empresa_id')->nullable(0);
            $table->integer('estado_venta_id')->nullable(0);
            $table->double('precio_venta');
            $table->double('precio_compra');
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
        Schema::dropIfExists('productos');
    }
}
