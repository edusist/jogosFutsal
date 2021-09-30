<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJogadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('jogadores', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('nome_jogador', 100);
        //     $table->string('posicao', 50);
        //     $table->string('presente', 5);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('jogadores');
    }
}
