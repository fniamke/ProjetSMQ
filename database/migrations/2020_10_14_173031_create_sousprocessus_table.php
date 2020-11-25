<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSousprocessusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sousprocessus', function (Blueprint $table) {
            $table->increments('IdSousProcessus');
            $table->integer('IdProcessus');
            $table->string('CodeSousProcessus');
            $table->string('LibSousProcessus');
            $table->integer('IdSousPilote')->nullable();           
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
        Schema::dropIfExists('sousprocessus');
    }
}
