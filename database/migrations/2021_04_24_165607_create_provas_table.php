<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('filiale_id')->nullable();
            $table->string('tot')->nullable();
            $table->string('stato')->nullable();
            $table->date('inizio_prova')->nullable();
            $table->date('fine_prova')->nullable();
            $table->integer('mese_fine')->nullable();
            $table->integer('anno_fine')->nullable();
            $table->integer('mese_inizio')->nullable();
            $table->integer('anno_inizio')->nullable();
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
        Schema::dropIfExists('provas');
    }
}
