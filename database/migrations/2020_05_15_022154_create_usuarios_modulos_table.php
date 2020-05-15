<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_modulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fk_modulo');
            $table->unsignedBigInteger('fk_usuario');
            $table->unsignedBigInteger('fk_creador');
            $table->integer('estado');
            $table->foreign('fk_usuario')->references('id')->on('usuarios');
            $table->foreign('fk_modulo')->references('id')->on('modulos');
            $table->foreign('fk_creador')->references('id')->on('usuarios');
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
        Schema::dropIfExists('usuarios_modulos');
    }
}
