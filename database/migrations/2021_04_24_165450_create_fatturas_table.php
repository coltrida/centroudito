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
            $table->bigInteger('id_prova')->nullable();
            $table->dateTime('data_fattura')->nullable();
            $table->string('acconto')->nullable();
            $table->string('nr_rate')->nullable();
            $table->string('tot_fattura')->nullable();
            $table->string('tot_fattura_scontato')->nullable();
            $table->string('sconto')->nullable();
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
