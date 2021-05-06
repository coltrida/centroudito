<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFatturasTable extends Migration
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
            $table->bigInteger('prova_id')->nullable();
            $table->date('data_fattura')->nullable();
            $table->integer('acconto')->nullable();
            $table->integer('nr_rate')->nullable();
            $table->integer('tot_fattura')->nullable();
            $table->integer('al_saldo')->nullable();
            $table->integer('tot_fattura_scontato')->nullable();
            $table->integer('sconto')->nullable();
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
}
