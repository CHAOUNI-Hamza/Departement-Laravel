<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('photo');  // Colonne pour la photo
            $table->string('nom');    // Colonne pour le nom
            $table->string('prenom'); // Colonne pour le prénom
            $table->text('bio')->nullable(); // Colonne pour la biographie, peut être null
            $table->foreignId('departement_id')->constrained(); // Colonne pour la relation avec 'departements'
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
        Schema::dropIfExists('teachers');
    }
};
