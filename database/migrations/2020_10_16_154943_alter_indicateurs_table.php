<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterIndicateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('indicateurs', function (Blueprint $table) 
        {         
            $table->integer('IdSousProcessus')->nullable();
            $table->integer('NumLigne')->nullable();       
            $table->boolean('Archiver')->nullable();       
            $table->id();

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
        Schema::table('indicateurs', function (Blueprint $table) {
            $table->dropColumn('IdSousProcessus');
            $table->dropColumn('NumLigne');
            $table->dropColumn('Archiver');
            $table->dropColumn('id');
            $table->dropColumn('IdSociete');
        });
    }
}
