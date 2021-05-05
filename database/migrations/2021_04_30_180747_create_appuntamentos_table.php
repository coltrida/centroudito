<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppuntamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appuntamentos', function (Blueprint $table) {
            $table->id();
            $table->date('giorno');
            $table->time('orario');
            $table->string('nota');
            $table->bigInteger('client_id');
            $table->bigInteger('user_id');
            $table->bigInteger('filiale_id')->nullable();
            $table->bigInteger('recapito_id')->nullable();
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
        Schema::dropIfExists('appuntamentos');
    }
}
