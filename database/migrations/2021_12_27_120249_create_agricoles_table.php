<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgricolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agricoles', function (Blueprint $table) {
            $table->id();
            $table->string('sites_id');
            $table->string('nom');
            $table->enum('categorisation', ['Coopérative Agricole']);
            $table->string('serviceAgrement');
            $table->string('nomGerant');
            $table->string('domaine');
            $table->string('capaciteProduction');
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
        Schema::dropIfExists('agricoles');
    }
}
