<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nro_documento', 30);
            $table->text('correo');
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->text('direccion');
            $table->string('telefono', 15);
            $table->text('password');
            $table->unsignedBigInteger('fk_perfil');
            $table->integer('estado');
            $table->integer('fk_creador');
            $table->timestamps();
            $table->foreign('fk_perfil')->references('id')->on('perfiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
