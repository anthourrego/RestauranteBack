<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promociones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fk_plato');
            $table->text('descripcion');
            $table->integer('precio');
            $table->integer('estado');
            $table->unsignedBigInteger('fk_creador');
            $table->timestamps();
            
            $table->foreign('fk_plato')->references('id')->on('platos');
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
        Schema::dropIfExists('promociones');
    }
}
