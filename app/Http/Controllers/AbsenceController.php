<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Agent;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absences = Absence::with('agent')->paginate(10);
        return view('absences.index', compact('absences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agents = Agent::all();
        return view('absences.create', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validform = $request->validate([
        'agent_id'     => 'required|exists:agents,id',
        'date_debut'   => 'required|date',
        'date_fin'     => 'required|date|after_or_equal:date_debut',
        'motif'        => 'required|string|max:255',
        'type_absence' => 'required|in:ordinaire,exceptionnelle',
    ], [
        'agent_id.required'       => 'Veuillez sélectionner un agent.',
        'agent_id.exists'         => 'L\'agent sélectionné n\'existe pas.',
        'date_fin.after_or_equal' => 'La date de fin doit être après la date de début.',
        'type_absence.required'   => 'Le type d\'absence est obligatoire.',
    ]);

    // Calcul automatique du nombre de jours
    $debut = \Carbon\Carbon::parse($validform['date_debut']);
    $fin   = \Carbon\Carbon::parse($validform['date_fin']);
    $validform['nb_jours'] = $debut->diffInDays($fin) + 1;

    // Règle 5 — ordinaire = défalquée / exceptionnelle = non défalquée
    $validform['est_defalquable'] = ($validform['type_absence'] === 'ordinaire') ? 1 : 0;

    Absence::create($validform);
    return redirect()->route('absence.index')
        ->with('success', 'Absence enregistrée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absence $absence)
    {
        return view('absences.show', compact('absence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $absence = Absence::find($id);
        $agents  = Agent::all();
        return view('absences.edit', compact('absence', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absence $absence)
    {
     $validform = $request->validate([
        'agent_id'     => 'required|exists:agents,id',
        'date_debut'   => 'required|date',
        'date_fin'     => 'required|date|after_or_equal:date_debut',
        'motif'        => 'required|string|max:255',
        'type_absence' => 'required|in:ordinaire,exceptionnelle',
    ], [
        'agent_id.required'       => 'Veuillez sélectionner un agent.',
        'date_fin.after_or_equal' => 'La date de fin doit être après la date de début.',
    ]);

    // Calcul automatique du nombre de jours
    $debut = \Carbon\Carbon::parse($validform['date_debut']);
    $fin   = \Carbon\Carbon::parse($validform['date_fin']);
    $validform['nb_jours'] = $debut->diffInDays($fin) + 1;

    // Règle 5 — recalcul automatique
    $validform['est_defalquable'] = ($validform['type_absence'] === 'ordinaire') ? 1 : 0;

    $absence->update($validform);
    return redirect()->route('absence.index')
        ->with('success', 'Absence modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absence $absence)
    {
        $absence->delete();
        return redirect()->route('absence.index')
            ->with('success', 'Absence supprimée avec succès.');
    }
}
