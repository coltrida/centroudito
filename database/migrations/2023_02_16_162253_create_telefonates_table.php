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
        Schema::create('telefonates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('eseguita_id');
            $table->bigInteger('client_id');
            $table->string('esito')->nullable();
            $table->string('note')->nullable();
            $table->boolean('effettuata')->nullable();
            $table->date('datarecall')->nullable();
            $table->integer('mese')->nullable();
            $table->integer('anno')->nullable();
            $table->date('created_at');
            $table->date('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefonates');
    }
};
