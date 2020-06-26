<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicacionImagenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacion_imagen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('publicacion_id')->nullable()->unsigned();
            $table->string('file_name',200)->nullable();
            $table->string('identificador',20)->nullable();
            $table->integer('user_id')->nullable()->unsigned();
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
        Schema::dropIfExists('publicacion_imagen');
    }
}
