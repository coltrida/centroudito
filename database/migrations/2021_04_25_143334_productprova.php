<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productprova extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prova', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('prova_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->string('orecchio')->nullable();
            $table->string('prezzo')->nullable();
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
        Schema::dropIfExists('productprova');
    }
}
