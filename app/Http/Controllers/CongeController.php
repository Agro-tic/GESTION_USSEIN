<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Agent;
use App\Models\Jourferie;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CongeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conges = Conge::with('agent')->paginate(10);
        return view('conges.index', compact('conges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agents = Agent::all();
        return view('conges.create', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validform = $request->validate([
            'agent_id'       => 'required|exists:agents,id',
            'date_cessation' => 'required|date',
            'jours_a_prendre'=> 'required|integer|min:1|max:72',
            'statut'         => 'nullable|in:en_attente,approuve,refuse',
        ], [
            'agent_id.required'        => 'Veuillez sélectionner un agent.',
            'agent_id.exists'          => 'L\'agent sélectionné n\'existe pas.',
            'jours_a_prendre.required' => 'Le nombre de jours est obligatoire.',
            'jours_a_prendre.max'      => 'Le nombre de jours ne peut pas dépasser 72.',
        ]);

        // Règle 3 & 4 — Calcul automatique de la date de reprise
        $validform['date_reprise'] = $this->calculerDateReprise(
            $validform['date_cessation'],
            $validform['jours_a_prendre']
        );

        // Règle 6 — Calcul des jours restants
        $agent = Agent::find($validform['agent_id']);
        $validform['jours_restants'] = $agent->jours_conges_dus
                                     - $validform['jours_a_prendre'];

        $validform['statut'] = $validform['statut'] ?? 'en_attente';

        Conge::create($validform);
        return redirect()->route('conge.index')
            ->with('success', 'Congé enregistré avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Conge $conge)
    {
        return view('conges.show', compact('conge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $conge  = Conge::find($id);
        $agents = Agent::all();
        return view('conges.edit', compact('conge', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conge $conge)
    {
        $validform = $request->validate([
            'agent_id'       => 'required|exists:agents,id',
            'date_cessation' => 'required|date',
            'jours_a_prendre'=> 'required|integer|min:1|max:72',
            'statut'         => 'nullable|in:en_attente,approuve,refuse',
        ], [
            'agent_id.required'        => 'Veuillez sélectionner un agent.',
            'jours_a_prendre.required' => 'Le nombre de jours est obligatoire.',
            'jours_a_prendre.max'      => 'Le nombre de jours ne peut pas dépasser 72.',
        ]);

        // Règle 3 & 4 — Recalcul de la date de reprise
        $validform['date_reprise'] = $this->calculerDateReprise(
            $validform['date_cessation'],
            $validform['jours_a_prendre']
        );

        // Règle 6 — Recalcul des jours restants
        $agent = Agent::find($validform['agent_id']);
        $validform['jours_restants'] = $agent->jours_conges_dus
                                     - $validform['jours_a_prendre'];

        $conge->update($validform);
        return redirect()->route('conge.index')
            ->with('success', 'Congé modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conge $conge)
    {
        $conge->delete();
        return redirect()->route('conge.index')
            ->with('success', 'Congé supprimé avec succès.');
    }

    /**
     * Règles 3 & 4 — Calcul de la date de reprise
     * - Date cessation = dernier jour de travail
     * - Si cessation tombe un vendredi → décompte commence lundi
     * - Sinon → décompte commence le lendemain (J+1)
     * - On saute les dimanches et les jours fériés
     */
    private function calculerDateReprise(string $dateCessation, int $joursAPrendre): string
    {
        // Récupérer tous les jours fériés en base
        $joursFeries = Jourferie::pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d');
        })->toArray();

        $cessation = Carbon::parse($dateCessation);

        // Règle 3 — si vendredi → décompte commence lundi
        if ($cessation->dayOfWeek === Carbon::FRIDAY) {
            $current = $cessation->copy()->addDays(3); // lundi
        } else {
            $current = $cessation->copy()->addDay(); // J+1
        }

        $joursComptes = 0;

        // Règle 4 — parcourir le calendrier en sautant dimanches et jours fériés
        while ($joursComptes < $joursAPrendre) {
            // Sauter les dimanches
            if ($current->dayOfWeek === Carbon::SUNDAY) {
                $current->addDay();
                continue;
            }
            // Sauter les jours fériés
            if (in_array($current->format('Y-m-d'), $joursFeries)) {
                $current->addDay();
                continue;
            }
            $joursComptes++;
            if ($joursComptes < $joursAPrendre) {
                $current->addDay();
            }
        }

        return $current->format('Y-m-d');
    }
}
