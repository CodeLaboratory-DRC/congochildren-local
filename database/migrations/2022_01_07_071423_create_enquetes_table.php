<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquetes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enfant_id');
            $table->string('debut');
            $table->string('travail_ant');
            $table->string('ameneur');
            $table->string('occupation');
            $table->string('motivation');
            $table->string('satisfaction');
            $table->string('maladie');
            $table->string('accident');
            $table->string('soin');
            $table->string('distance_soin');
            $table->string('distance_mine');
            $table->string('patron');
            $table->string('abandonner');
            $table->string('autre_activite')->nullable();
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
        Schema::dropIfExists('enquetes');
    }
}
