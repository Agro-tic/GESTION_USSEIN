<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
     protected $fillable = [
        'agent_id',
        'date_cessation',
        'date_reprise',
        'jours_a_prendre',
        'jours_restants',
        'statut',
    ];

    protected $casts = [
        'date_cessation' => 'date:Y-m-d',
        'date_reprise'   => 'date:Y-m-d',
    ];

    // ── Relation — un congé appartient à un agent ────────────
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
