<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyserisquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyserisques', function (Blueprint $table) {
            $table->increments('IdAnalyserisques');
            $table->integer('IdProcessus');
            $table->integer('IdGravite');
            $table->integer('IdProbabilite');
            $table->integer('IdDetection');
            $table->integer('IdCriticite');
            $table->string('LibRisqueOpportunite');
            $table->string('Nature');
            $table->string('Effets');
            $table->string('Causes');
            $table->string('DescriptionMA'); //=Description Maitrise Actuelle
            $table->double('EvaluationMA'); //=Evaluation Maitrise Actuelle
            $table->double('EvaluationRR'); //=Evaluation Risque Résiduel
            $table->dateTime('DateRevision', 0);
            $table->boolean('Archiver');

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
        Schema::dropIfExists('analyserisques');
    }
}
