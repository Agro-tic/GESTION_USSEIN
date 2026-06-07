<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = Agent::paginate(5);
        return view('agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validform = $request->validate([
            'nom'                           => 'required|string|max:255',
            'prenom'                        => 'required|string|max:255',
            'matricule'                     => 'required|string|max:255|unique:agents,matricule',
            'lieu_affectation'              => 'required|string|max:255',
            'date_prise_service'            => 'required|date|before_or_equal:today',
            'sexe'                          => 'required|in:M,F',
            'nb_enfants'                    => 'nullable|integer|min:0|max:20',
            'jours_conges_annee_precedente' => 'nullable|integer|min:0|max:72',
            'jours_conges_annee_courante'   => 'nullable|integer|min:0|max:72',
            'absences_defalquer'            => 'nullable|integer|min:0',
            'actif'                         => 'nullable|boolean',
            'annee_courante'                => 'nullable|integer',
        ], [
            'matricule.unique'                   => 'Ce matricule existe déjà, veuillez en choisir un autre!',
            'date_prise_service.before_or_equal' => 'La date de prise de service ne peut pas être dans le futur.',
            'sexe.required'                      => 'Le sexe est obligatoire.',
        ]);

        $validform['jours_conges_dus'] = $this->calculerJoursDus(
            $validform['jours_conges_annee_precedente'] ?? 0,
            $validform['jours_conges_annee_courante']   ?? 24,
            $validform['sexe'],
            $validform['nb_enfants']                    ?? 0,
            $validform['absences_defalquer']             ?? 0
        );

        $validform['jours_restants'] = $validform['jours_conges_dus']
                                     - ($validform['absences_defalquer'] ?? 0);

        $validform['annee_courante'] = date('Y');

        Agent::create($validform);
        return redirect()->route('agent.index')  // ← sans s
            ->with('success', 'Agent créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        return view('agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $agent = Agent::find($id);
        return view('agents.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        $validform = $request->validate([
            'nom'                           => 'required|string|max:255',
            'prenom'                        => 'required|string|max:255',
            'matricule'                     => 'required|string|max:255|unique:agents,matricule,' . $agent->id,
            'lieu_affectation'              => 'required|string|max:255',
            'date_prise_service'            => 'required|date|before_or_equal:today',
            'sexe'                          => 'required|in:M,F',
            'nb_enfants'                    => 'nullable|integer|min:0|max:20',
            'jours_conges_annee_precedente' => 'nullable|integer|min:0|max:72',
            'jours_conges_annee_courante'   => 'nullable|integer|min:0|max:72',
            'absences_defalquer'            => 'nullable|integer|min:0',
            'actif'                         => 'nullable|boolean',
            'annee_courante'                => 'nullable|integer',
        ], [
            'date_prise_service.before_or_equal' => 'La date de prise de service ne peut pas être dans le futur.',
        ]);

        $validform['jours_conges_dus'] = $this->calculerJoursDus(
            $validform['jours_conges_annee_precedente'] ?? 0,
            $validform['jours_conges_annee_courante']   ?? 24,
            $validform['sexe'],
            $validform['nb_enfants']                    ?? 0,
            $validform['absences_defalquer']             ?? 0
        );

        $validform['jours_restants'] = $validform['jours_conges_dus']
                                     - ($validform['absences_defalquer'] ?? 0);

        $agent->update($validform);
        return redirect()->route('agent.index')  // ← sans s
            ->with('success', 'Agent modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('agent.index')  // ← sans s
            ->with('success', 'Agent supprimé avec succès.');
    }

    /**
     * Règle 1 — Calcul des jours de congés dus
     */
    private function calculerJoursDus(
        int $reliquatN1,
        int $congesAnnee,
        string $sexe,
        int $nbEnfants,
        int $absencesDefalquees
    ): int {
        $bonusEnfants = ($sexe === 'F') ? $nbEnfants : 0;
        $joursDus     = $reliquatN1 + $congesAnnee + $bonusEnfants - $absencesDefalquees;
        return min(max($joursDus, 0), 72);
    }
}
