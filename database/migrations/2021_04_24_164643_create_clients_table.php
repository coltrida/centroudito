<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cognome');
            $table->string('codfisc')->unique()->nullable();
            $table->string('indirizzo');
            $table->string('citta');
            $table->string('cap');
            $table->string('provincia');
            $table->string('telefono');
            $table->string('tipo');
            $table->string('fonte')->nullable();
            $table->string('mail')->nullable();
            $table->char('recall')->nullable();
            $table->date('datarecall')->nullable();
            $table->date('datanascita')->nullable();
            $table->integer('meseNascita')->nullable();
            $table->integer('giornoNascita')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('filiale_id')->unsigned();
            $table->bigInteger('recapito_id')->unsigned()->nullable();
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
        Schema::dropIfExists('clients');
    }
}
