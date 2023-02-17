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
        Schema::create('deltas', function (Blueprint $table) {
            $table->id()->startingValue(2000);
            $table->string('nome')->nullable();
            $table->integer('anno')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('budgetAnno')->nullable();
            $table->string('premio')->nullable();
            $table->string('stipendio')->nullable();
            $table->string('provvigione')->nullable();
            $table->string('gennaio')->nullable();
            $table->string('febbraio')->nullable();
            $table->string('marzo')->nullable();
            $table->string('aprile')->nullable();
            $table->string('maggio')->nullable();
            $table->string('giugno')->nullable();
            $table->string('luglio')->nullable();
            $table->string('agosto')->nullable();
            $table->string('settembre')->nullable();
            $table->string('ottobre')->nullable();
            $table->string('novembre')->nullable();
            $table->string('dicembre')->nullable();
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
        Schema::dropIfExists('deltas');
    }
};
