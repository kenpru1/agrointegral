<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('celos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('animal_id')->nullable()->unsigned();
            $table->timestamps('fecha_deteccion')->nullable();
            $table->string('obervaciones',800)->nullable();
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
        Schema::dropIfExists('celos');
    }
}
