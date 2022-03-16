<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->enum('province',['haut-katanga', 'lualaba']);
            $table->string('territoire')->nullable();
            $table->string('localite')->nullable();
            $table->string('initial');
            $table->string('responsable')->nullable();
            $table->string('phone')->nullable();
            $table->string('users_id');
            $table->string('localites_id');
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
        Schema::dropIfExists('sites');
    }
}
