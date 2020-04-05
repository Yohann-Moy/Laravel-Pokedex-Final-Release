<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePokemon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokemon', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedInteger('user_id')->nullable(); // FOREIGN KEY //
            $table->integer('numero')->default('0'); /* Le numero du pokemon dans le pokedex */
            $table->string('nom',50)->default('MissingN0'); /* Le nom du pokemon */
            $table->string('type1',20)->default('Vol'); /* Le type n°1 du pokemon */
            $table->string('type2',50)->default('/'); /* Le type n°2 du pokemon */
            $table->string('image',100)->default('/img/missingno.png'); /* Le lien pour l'image du pokemon */
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
        Schema::dropIfExists('pokemon');
        /* Schema::dropIfExists('laravellPokedex');  OLD FONCTIONNEL SI ON DROP LA TABLE POKEMON MANUELLEMENT */
    }
}
