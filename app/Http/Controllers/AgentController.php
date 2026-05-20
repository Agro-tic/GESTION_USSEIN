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
        //$agents = Agent::all();
        $agents = Agent::paginate(10);
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
            'date_prise_service'            => 'required|date',
            'genre'                         => 'required|in:M,F',
            'nb_enfants'                    => 'nullable|integer|min:0',
            'jours_conges_annee_precedente' => 'nullable|integer|min:0',
            'jours_conges_annee_courante'   => 'nullable|integer|min:0',
            'absences_defalquer'            => 'nullable|integer|min:0',
            'actif'                         => 'nullable|boolean',
            'annee_courante'                => 'nullable|integer',
        ], [
            'matricule.unique' => 'Ce matricule existe déjà, veuillez en choisir un autre!',
        ]);

        Agent::create($validform);
        return redirect()->route('agent.index')
            ->with('success', 'Agent créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        //dd($agent);
        return view('agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $agent = Agent::find($id);
        //dd($agent);
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
            'lieu_affectation'              => 'required|string|max:255',
            'date_prise_service'            => 'required|date',
            'genre'                         => 'required|in:M,F',
            'nb_enfants'                    => 'nullable|integer|min:0',
            'jours_conges_annee_precedente' => 'nullable|integer|min:0',
            'jours_conges_annee_courante'   => 'nullable|integer|min:0',
            'absences_defalquer'            => 'nullable|integer|min:0',
            'actif'                         => 'nullable|boolean',
            'annee_courante'                => 'nullable|integer',
        ]);

        $agent->update($validform);
        return redirect()->route('agent.index')
            ->with('success', 'Agent modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('agent.index')
            ->with('success', 'Agent supprimé avec succès.');
    }
}
