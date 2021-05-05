<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->integer('budgetAnno');
            $table->integer('premio')->nullable();
            $table->integer('stipendio')->nullable();
            $table->integer('provvigione')->nullable();
            $table->integer('gennaio');
            $table->integer('febbraio');
            $table->integer('marzo');
            $table->integer('aprile');
            $table->integer('maggio');
            $table->integer('giugno');
            $table->integer('luglio');
            $table->integer('agosto');
            $table->integer('settembre');
            $table->integer('ottobre');
            $table->integer('novembre');
            $table->integer('dicembre');
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
        Schema::dropIfExists('budgets');
    }
}
