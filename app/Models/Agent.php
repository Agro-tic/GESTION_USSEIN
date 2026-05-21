<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = [
                'nom',
                'prenom',
                'matricule',
                'lieu_affectation',
                'date_prise_service',
                'genre', 'nb_enfants',
                'jours_conges_annee_precedente',
                'jours_conges_annee_courante',
                'jours_conges_dus',
                'absences_defalquer',
                'jours_restants',
                'actif',
                'annee_courante',
];
}

