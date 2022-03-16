<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enfant_id');
            $table->string('nom_pere')->nullable();
            $table->string('nom_mere')->nullable();
            $table->string('instruction_pere')->nullable();
            $table->string('instruction_mere')->nullable();
            $table->string('matrimonial')->nullable();
            $table->string('nb_enfant');
            $table->string('nb_homme');
            $table->string('nb_femme');
            $table->string('activite_princ')->nullable();
            $table->string('activite_sec')->nullable();
            $table->string('revenu_jour')->nullable();
            $table->string('nb_enfant_mine');
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
        Schema::dropIfExists('familles');
    }
}
