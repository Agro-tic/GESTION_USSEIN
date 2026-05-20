<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agent extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'matricule',
        'lieu_affectation',
        'date_prise_service',
        'genre',
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

    // ─── Relations ───────────────────────────────────────────────

    /**
     * Un agent a plusieurs congés.
     */
    public function conges(): HasMany
    {
        return $this->hasMany(Conge::class);
    }

    /**
     * Un agent a plusieurs absences.
     */
    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }

    /**
     * Un agent peut être lié à un utilisateur (optionnel).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ─── Accessors ───────────────────────────────────────────────

    /**
     * Nom complet de l'agent.
     */
    public function getNomCompletAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Genre affiché lisiblement.
     */
    public function getGenreLibelleAttribute(): string
    {
        return $this->genre === 'F' ? 'Féminin' : 'Masculin';
    }
}
