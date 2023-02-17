<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('indirizzo')->nullable();
            $table->string('citta')->nullable();
            $table->string('cap')->nullable();
            $table->string('provincia')->nullable();
            $table->string('telefono')->nullable();
            $table->string('telefono2')->nullable();
            $table->string('telefono3')->nullable();
            $table->bigInteger('tipologia_id')->nullable();
            $table->string('mail')->nullable();
            $table->date('datanascita')->nullable();
            $table->string('luogoNascita')->nullable();
            $table->integer('meseNascita')->nullable();
            $table->integer('giornoNascita')->nullable();
            $table->bigInteger('marketing_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('filiale_id')->unsigned()->nullable();
            $table->bigInteger('recapito_id')->unsigned()->nullable();
            $table->bigInteger('medico_id')->unsigned()->nullable();
            $table->integer('mese')->nullable();
            $table->integer('anno')->nullable();
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
};
