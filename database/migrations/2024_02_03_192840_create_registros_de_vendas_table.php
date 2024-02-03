<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosDeVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros_de_vendas', function (Blueprint $table) {
            $table->id();
            $table->string('item_vendido');
            $table->integer('quantidade_vendida');
            $table->integer('preco_vendido');
            $table->integer('estoque_atual');
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
        Schema::dropIfExists('registros_de_vendas');
    }
}
