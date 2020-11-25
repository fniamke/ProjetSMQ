<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocieteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('societe', function (Blueprint $table) {
            $table->increments('IdSociete');
            $table->string('NomSociete');
            $table->string('NomContact');
            $table->string('email')->unique();
            $table->string('Telephone');
            $table->string('Fax');
            $table->boolean('Statut');

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
        Schema::dropIfExists('societe');
    }
}
