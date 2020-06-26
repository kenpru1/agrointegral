<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboresCuartelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labores_cuarteles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('labor_id')->nullable()->unsigned();
            $table->integer('cuartel_id')->nullable()->unsigned();
            $table->double('hectareas')->nullable();
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
        Schema::dropIfExists('labores_cuarteles');
    }
}
