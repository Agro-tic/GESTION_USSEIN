<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Agent extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'matricule',
        'lieu_affectation',
        'date_prise_service',
        'sexe',
        'nb_enfants',
        'jours_conges_annee_precedente',
        'jours_conges_annee_courante',
        'jours_conges_dus',
        'absences_defalquer',
        'jours_restants',
        'actif',
        'annee_courante',
    ];

    protected $casts = [
        'date_prise_service' => 'date',
        'actif'              => 'boolean',
    ];

    // ── Relations (utilisées dans les modules suivants) ──────
    public function conges()
    {
        return $this->hasMany(Conge::class, 'agent_id');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class, 'agent_id');
    }

    // ── Accesseurs ───────────────────────────────────────────

    // Retourne "Prénom NOM" en une seule propriété
    public function getNomCompletAttribute(): string
    {
        return $this->prenom . ' ' . strtoupper($this->nom);
    }

    // Vérifie si l'agent a au moins 12 mois de service (Règle 1)
    public function getEligibleCongesAttribute(): bool
    {
        return $this->date_prise_service->diffInMonths(Carbon::today()) >= 12;
    }

    // Retourne "Masculin" ou "Féminin"
    public function getSexeLibelleAttribute(): string
    {
        return $this->sexe === 'M' ? 'Masculin' : 'Féminin';
    }
}
