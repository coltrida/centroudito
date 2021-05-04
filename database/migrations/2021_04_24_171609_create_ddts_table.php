<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDdtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ddts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('filiale_id')->unsigned();
            $table->string('nome_destinazione');
            $table->string('indirizzo_destinazione');
            $table->string('citta_destinazione');
            $table->string('cap_destinazione');
            $table->string('provincia_destinazione');
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
        Schema::dropIfExists('ddts');
    }
}
