<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) 
        {
            
            $table->boolean('pilote')->nullable();           
            $table->integer('Idfonction')->nullable();
            $table->boolean('SousPilote')->nullable();
            $table->boolean('Auditeur')->nullable();
            
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('pilote');
            $table->dropColumn('Idfonction');
            $table->dropColumn('SousPilote');
            $table->dropColumn('Auditeur');
        });
    }
}
