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
        Schema::create('fatturatis', function (Blueprint $table) {
            $table->id()->startingValue(1000);
            $table->integer('anno')->nullable();
            $table->string('nome')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->integer('budgetAnno')->nullable();
            $table->integer('asl')->nullable();
            $table->integer('binaurale')->nullable();
            $table->integer('provvigione')->nullable();
            $table->integer('gennaio')->nullable();
            $table->integer('febbraio')->nullable();
            $table->integer('marzo')->nullable();
            $table->integer('aprile')->nullable();
            $table->integer('maggio')->nullable();
            $table->integer('giugno')->nullable();
            $table->integer('luglio')->nullable();
            $table->integer('agosto')->nullable();
            $table->integer('settembre')->nullable();
            $table->integer('ottobre')->nullable();
            $table->integer('novembre')->nullable();
            $table->integer('dicembre')->nullable();
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
        Schema::dropIfExists('fatturatis');
    }
};
