<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornitoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornitores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('codfisc')->nullable();
            $table->string('citta')->nullable();
            $table->string('pec')->nullable();
            $table->string('univoco')->nullable();
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
        Schema::dropIfExists('fornitores');
    }
}
