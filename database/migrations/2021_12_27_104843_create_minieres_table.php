<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minieres', function (Blueprint $table) {
            $table->id();
            $table->string('sites_id');
            $table->string('nom');
            $table->enum('categorisation', ['Coopérative Minière','Exploitant artisanal','Creuseur']);
            $table->string('serviceAgrement');
            $table->string('nomGerant');
            $table->enum('domaine',['Cobalt','Minerais associés']);
            $table->string('autreDomaines')->nullable();
            $table->string('users_id');
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
        Schema::dropIfExists('minieres');
    }
}
