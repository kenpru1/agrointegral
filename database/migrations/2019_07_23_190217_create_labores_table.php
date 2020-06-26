<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labores', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('actividad_gasto_id')->nullable()->unsigned();
            $table->string('labor', 100)->nullable();
            $table->double('neto')->nullable();
            $table->double('iva')->nullable();
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
        Schema::dropIfExists('labores');
    }
}
