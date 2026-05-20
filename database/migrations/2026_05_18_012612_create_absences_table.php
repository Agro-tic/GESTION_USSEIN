<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            // Lien avec l'agent
        $table->foreignId('agent_id')->constrained('agents')->cascadeOnDelete();
        $table->date('date_debut');
        $table->date('date_fin');
        $table->integer('nb_jours');
        $table->integer('annee');
        // Type : ordinaire ou exceptionnelle
        $table->enum('type', ['ordinaire', 'exceptionnelle'])->default('ordinaire');
        // Motif de l'absence
        $table->enum('motif', ['mariage', 'bapteme', 'deces', 'autre', 'ordinaire'])->default('ordinaire');
        $table->text('observation')->nullable();
        // Si true, l'absence est déduite des jours de congé
        $table->boolean('deductible')->default(true);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
