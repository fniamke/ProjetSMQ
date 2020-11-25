<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->increments('IdTaches');
            $table->integer('IdPlanaction');
            $table->string('LibTaches');
            $table->integer('IdIntervenant');
            $table->integer('IdTypeMoyen');
            $table->dateTime('DateDebut', 0);
            $table->dateTime('DateFin', 0);
            $table->tinyInteger('Etat');
            
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
        Schema::dropIfExists('taches');
    }
}
