<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('IdSociete');
            $table->integer('IdOrigine');
            $table->integer('IdExpediteur');
            $table->string('Expediteur');
            $table->string('emailExpediteur');
            $table->integer('IdDestinataire');
            $table->string('Destinataire');
            $table->string('emailDestinataire');
            $table->text('message');
            $table->boolean('statut');
            
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
        Schema::dropIfExists('messages');
    }
}
