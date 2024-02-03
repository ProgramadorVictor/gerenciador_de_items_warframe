<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_itens', function (Blueprint $table) {
            $table->unsignedBigInteger('id_item');
            $table->string('item');
            $table->integer('quantidade')->default(1);
            $table->foreign('id_item')->references('id')->on('itens');
            $table->string('set_completo',1)->nullable();
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
        Schema::dropIfExists('inventario_itens');
    }
}
