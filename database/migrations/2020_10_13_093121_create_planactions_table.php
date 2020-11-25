<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planactions', function (Blueprint $table) {
            $table->increments('IdPlanaction');
            $table->string('CodePlanaction')->unique();
            $table->integer('IdProcessus');
            $table->string('LibPlanaction');
            
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
        Schema::dropIfExists('planactions');
    }
}
