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
        Schema::create('audiometrias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->string('_125d')->nullable();
            $table->string('_250d')->nullable();
            $table->string('_500d')->nullable();
            $table->string('_1000d')->nullable();
            $table->string('_1500d')->nullable();
            $table->string('_2000d')->nullable();
            $table->string('_3000d')->nullable();
            $table->string('_4000d')->nullable();
            $table->string('_6000d')->nullable();
            $table->string('_8000d')->nullable();
            $table->string('_125s')->nullable();
            $table->string('_250s')->nullable();
            $table->string('_500s')->nullable();
            $table->string('_1000s')->nullable();
            $table->string('_1500s')->nullable();
            $table->string('_2000s')->nullable();
            $table->string('_3000s')->nullable();
            $table->string('_4000s')->nullable();
            $table->string('_6000s')->nullable();
            $table->string('_8000s')->nullable();
            $table->string('_125ossd')->nullable();
            $table->string('_250ossd')->nullable();
            $table->string('_500ossd')->nullable();
            $table->string('_1000ossd')->nullable();
            $table->string('_1500ossd')->nullable();
            $table->string('_2000ossd')->nullable();
            $table->string('_3000ossd')->nullable();
            $table->string('_4000ossd')->nullable();
            $table->string('_6000ossd')->nullable();
            $table->string('_8000ossd')->nullable();
            $table->string('_125osss')->nullable();
            $table->string('_250osss')->nullable();
            $table->string('_500osss')->nullable();
            $table->string('_1000osss')->nullable();
            $table->string('_1500osss')->nullable();
            $table->string('_2000osss')->nullable();
            $table->string('_3000osss')->nullable();
            $table->string('_4000osss')->nullable();
            $table->string('_6000osss')->nullable();
            $table->string('_8000osss')->nullable();
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
        Schema::dropIfExists('audiometrias');
    }
};
