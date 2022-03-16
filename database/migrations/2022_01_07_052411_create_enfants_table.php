<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id');
            $table->string('nom');
            $table->string('age');
            $table->enum('genre',['m','f']);
            $table->string('adresse')->nullable();
            $table->boolean('parent_vie');
            $table->boolean('deplace');
            $table->string('habitation');
            $table->string('rang_famille');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('enfants');
    }
}
