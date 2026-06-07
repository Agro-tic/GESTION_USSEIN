<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $fillable = [
        'agent_id',
        'date_debut',
        'date_fin',
        'nb_jours',
        'motif',
        'type_absence',
        'est_defalquable',
    ];

    protected $casts = [
        'date_debut'      => 'date:Y-m-d',
        'date_fin'        => 'date:Y-m-d',
        'est_defalquable' => 'boolean',
    ];

    // ── Relation — une absence appartient à un agent ─────────
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
