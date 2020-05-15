<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nombre');
            $table->text('tag');
            $table->text('icono');
            $table->text('ruta');
            $table->unsignedBigInteger('fk_modulo_tipo');
            $table->integer('fk_modulo');
            $table->integer('estado');
            $table->unsignedBigInteger('fk_creador');
            $table->timestamps();

            $table->foreign('fk_modulo_tipo')->references('id')->on('modulo_tipos');
            $table->foreign('fk_creador')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modulos');
    }
}
