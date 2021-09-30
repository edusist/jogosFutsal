<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRodadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // Schema::create('rodadas', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->dateTime('data_rodada')->nullable();
        //     $table->timestamps();

        //     $table->integer('user_id')->unsigned();
        //     $table->foreign('user_id')
        //         ->references('id')
        //         ->on('users')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');

        //     $table->integer('jogador_id')->unsigned();
        //     $table->foreign('jogador_id')
        //         ->references('id')
        //         ->on('jogadores')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');

        //     $table->integer('timefutsal_id')->unsigned();
        //     $table->foreign('timefutsal_id')
        //         ->references('id')
        //         ->on('timesfutsal')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rodadas');
    }
}
