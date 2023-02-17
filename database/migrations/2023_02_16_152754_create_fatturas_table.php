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
        Schema::create('fatturas', function (Blueprint $table) {
            $table->id();
            $table->integer('progressivo')->nullable();
            $table->bigInteger('prova_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->date('data_fattura')->nullable();
            $table->date('ultima_rata')->nullable();
            $table->date('data_saldo')->nullable();
            $table->date('data_pagamentoAudio')->nullable();
            $table->integer('mese_fattura')->nullable();
            $table->integer('anno_fattura')->nullable();
            $table->integer('acconto')->nullable();
            $table->integer('nr_rate')->nullable();
            $table->integer('tot_fattura')->nullable();
            $table->integer('al_saldo')->nullable();
            $table->integer('tot_fattura_scontato')->nullable();
            $table->integer('sconto')->nullable();
            $table->boolean('saldata')->nullable()->default(0);
            $table->boolean('pagatoAudio')->nullable()->default(0);
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
        Schema::dropIfExists('fatturas');
    }
};
