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
        Schema::create('orario_medicos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('medico_id');
            $table->string('dove');
            $table->string('giorno');
            $table->string('orario');
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
        Schema::dropIfExists('orario_medicos');
    }
};
