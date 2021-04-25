<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('codfisc');
            $table->string('indirizzo');
            $table->string('citta');
            $table->string('cap');
            $table->string('provincia');
            $table->string('telefono');
            $table->string('tipo');
            $table->string('fonte');
            $table->char('recall')->nullable();
            $table->date('datarecall')->nullable();
            $table->bigInteger('user_id')->unsigned();
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
        Schema::dropIfExists('clients');
    }
}
