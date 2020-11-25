<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicateurs', function (Blueprint $table) {
            $table->id();
            $table->integer('IdIndicateur');
            $table->integer('IdProcessus');
            $table->string('LibIndicateur');
            $table->string('Periodicite');
            $table->dateTime('DateDebutPeriode', 0);
            $table->string('DebutPeriode');
            $table->string('FinPeriode');
            $table->double('Objectif');
            $table->double('Resultat');
            $table->tinyInteger('Etat');
            $table->string('Observation');
            
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
        Schema::dropIfExists('indicateurs');
    }
}
