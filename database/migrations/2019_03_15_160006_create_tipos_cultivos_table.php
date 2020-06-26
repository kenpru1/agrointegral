<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposCultivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_cultivos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->boolean('estado')->default(0)->nullable();
            $table->integer('empresa_id')->nullable(0);
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
        Schema::dropIfExists('tipos_cultivos');
    }
}
