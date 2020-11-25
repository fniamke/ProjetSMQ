<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSousprocessusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sousprocessus', function (Blueprint $table) 
        {           
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
        Schema::table('sousprocessus', function (Blueprint $table) {
            $table->dropColumn('IdSociete');
        });
    }
}
