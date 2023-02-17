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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->bigInteger('user_id');
            $table->integer('settimana');
            $table->string('lun')->nullable();
            $table->string('mar')->nullable();
            $table->string('mer')->nullable();
            $table->string('gio')->nullable();
            $table->string('ven')->nullable();
            $table->string('sab')->nullable();
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
        Schema::dropIfExists('agendas');
    }
};
