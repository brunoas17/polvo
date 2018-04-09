<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedidoProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_pedido')->nullable();
            $table->integer('id_produto')->nullable();
            $table->foreign('id_pedido')->references('id')->on('pedidos; id_produto')->onDelete('id')->onUpdate('produtos');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pedido_produtos');
    }
}
