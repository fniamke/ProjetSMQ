<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartiesinteresseesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partiesinteressees', function (Blueprint $table) {
            $table->increments('IdPartiesInt');
            $table->integer('IdProcessus');
            $table->integer('IdNivImportance');
            $table->integer('IdNivRelation');
            $table->integer('IdCotation');
            $table->string('LibPartiesInt');
            $table->string('Contexte');
            $table->string('Attentes');
            $table->string('Risques');
            $table->string('Opportunites');
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
        Schema::dropIfExists('partiesinteressees');
    }
}
