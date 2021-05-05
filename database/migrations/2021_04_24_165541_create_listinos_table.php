<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listinos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->bigInteger('fornitore_id')->nullable();
            $table->string('categoria')->nullable();
            $table->string('costo')->nullable();
            $table->string('prezzolistino')->nullable();
            $table->string('iva')->nullable();
            $table->string('giorniTempoDiReso')->nullable();
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
        Schema::dropIfExists('listinos');
    }
}
