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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('matricola')->nullable();
            $table->bigInteger('stato_id')->nullable();
            $table->bigInteger('filiale_id')->nullable();
            $table->bigInteger('listino_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('fornitore_id')->nullable();
            $table->bigInteger('ddt_id')->nullable();
            $table->bigInteger('fattura_id')->nullable();
            $table->date('datacarico')->nullable();
            $table->boolean('pericoloRestituzione')->nullable()->default(false);
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
        Schema::dropIfExists('products');
    }
};
