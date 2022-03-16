<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJeunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jeunes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enfant_id');
            $table->string('etat_civil');
            $table->string('coinjoint');
            $table->string('nb_enfant');
            $table->string('nb_garcon');
            $table->string('nb_fille');
            $table->string('nb_scolarise');
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
        Schema::dropIfExists('jeunes');
    }
}
