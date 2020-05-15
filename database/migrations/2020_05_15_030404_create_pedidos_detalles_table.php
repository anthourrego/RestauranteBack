<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fk_pedido');
            $table->unsignedBigInteger('fk_plato');
            $table->unsignedBigInteger('fk_plato_dia');
            $table->unsignedBigInteger('fk_promocion');
            $table->integer('precio');
            $table->integer('estado');
            $table->unsignedBigInteger('fk_creador');
            $table->timestamps();
            
            $table->foreign('fk_pedido')->references('id')->on('pedidos');
            $table->foreign('fk_plato')->references('id')->on('platos');
            $table->foreign('fk_plato_dia')->references('id')->on('plato_dias');
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
        Schema::dropIfExists('pedidos_detalles');
    }
}
