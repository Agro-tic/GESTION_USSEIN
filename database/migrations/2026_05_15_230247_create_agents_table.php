<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('matricule')->unique();
            $table->string('lieu_affectation');
            $table->date('date_prise_service');
            $table->enum('sexe', ['M', 'F']);
            $table->integer('nb_enfants')->default(0);
            $table->integer('jours_conges_annee_precedente')->default(0);
            $table->integer('jours_conges_annee_courante')->default(24);
            $table->integer('jours_conges_dus')->default(0);
            $table->integer('absences_defalquer')->default(0);
            $table->integer('jours_restants')->default(0);
            $table->boolean('actif')->default(true);
            $table->integer('annee_courante')->default(date('Y'));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
