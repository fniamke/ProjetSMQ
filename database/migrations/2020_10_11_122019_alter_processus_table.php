<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProcessusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('processus', function (Blueprint $table) 
        {
            $table->integer('IdPilote')->nullable();           
            $table->integer('IdSousPilote')->nullable();           
            $table->integer('IdSociete')->nullable();           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('processus', function (Blueprint $table) {
            $table->dropColumn('IdPilote');
            $table->dropColumn('IdSousPilote');
            $table->dropColumn('IdSociete');
        });
    }
}
