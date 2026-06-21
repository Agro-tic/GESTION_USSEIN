<?php

namespace App\Http\Controllers;

use App\Models\Jourferie;
use Illuminate\Http\Request;

class JourFerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jourferies = Jourferie::paginate(5);
        return view('jourferies.index', compact('jourferies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jourferies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validform = $request->validate([
            'nom'   => 'required|string|max:255',
            'date'  => 'required|date',
            'annee' => 'required|integer|min:2000|max:2100',
        ], [
            'nom.required'  => 'Le nom du jour férié est obligatoire.',
            'date.required' => 'La date est obligatoire.',
        ]);

        // L'année est extraite automatiquement de la date
        $validform['annee'] = date('Y', strtotime($validform['date']));

        Jourferie::create($validform);
        return redirect()->route('jourferie.index')
            ->with('success', 'Jour férié ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jourferie $jourferie)
    {
        return view('jourferies.show', compact('jourferie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jourferie = Jourferie::find($id);
        return view('jourferies.edit', compact('jourferie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jourferie $jourferie)
    {
        $validform = $request->validate([
            'nom'   => 'required|string|max:255',
            'date'  => 'required|date',
            'annee' => 'required|integer|min:2000|max:2100',
        ], [
            'nom.required'  => 'Le nom du jour férié est obligatoire.',
            'date.required' => 'La date est obligatoire.',
        ]);

        // L'année est recalculée automatiquement depuis la date
        $validform['annee'] = date('Y', strtotime($validform['date']));

        $jourferie->update($validform);
        return redirect()->route('jourferie.index')
            ->with('success', 'Jour férié modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jourferie $jourferie)
    {
        $jourferie->delete();
        return redirect()->route('jourferie.index')
            ->with('success', 'Jour férié supprimé avec succès.');
    }
}
