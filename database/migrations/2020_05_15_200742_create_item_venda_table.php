<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemVendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_venda', function (Blueprint $table) {
            $table->id('id_item_venda');
            $table->foreignId('venda');
            $table->foreignId('produto');
            $table->double('valor_produto', 8, 2);
            $table->integer('quantidade');

            $table->foreign('venda')->references('id_venda')->on('venda');
            $table->foreign('produto')->references('id_produto')->on('produto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_venda');
    }
}
