<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('gamer_id');
            $table->longText('question');
            $table->longText('missings');
            $table->boolean('is_answered')->default(false);
            $table->integer('points')->default(0);
            $table->integer('attempts')->default(0);

            $table->foreign('gamer_id')
                    ->references('id')
                    ->on('gamers')
                    ->onDelete('cascade');
                    
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
        Schema::dropIfExists('games');
    }
}
