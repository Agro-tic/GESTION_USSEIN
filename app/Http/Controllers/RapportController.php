<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Conge;
use App\Models\Absence;
use Barryvdh\DomPDF\Facade\Pdf;

class RapportController extends Controller
{
    /**
     * Page principale des rapports
     */
    public function index()
    {
        // Récupérer les lieux d'affectation distincts
        $lieux = Agent::select('lieu_affectation')
                      ->distinct()
                      ->orderBy('lieu_affectation')
                      ->pluck('lieu_affectation');

        $totalAgents  = Agent::count();
        $totalConges  = Conge::count();
        $totalAbsences = Absence::count();

        return view('rapports.index', compact('lieux', 'totalAgents', 'totalConges', 'totalAbsences'));
    }

    /**
     * PDF — Fiche individuelle d'un agent
     */
    public function ficheAgent($id)
    {
        $agent    = Agent::findOrFail($id);
        $conges   = Conge::where('agent_id', $id)->orderBy('date_cessation', 'desc')->get();
        $absences = Absence::where('agent_id', $id)->orderBy('date_debut', 'desc')->get();

        $pdf = Pdf::loadView('rapports.fiche_agent', compact('agent', 'conges', 'absences'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('fiche_agent_' . $agent->matricule . '.pdf');
    }

    /**
     * PDF — Rapport par lieu d'affectation
     */
    public function rapportLieu($lieu)
    {
        $agents = Agent::where('lieu_affectation', $lieu)
                       ->orderBy('nom')
                       ->get();

        $pdf = Pdf::loadView('rapports.rapport_lieu', compact('agents', 'lieu'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('rapport_' . str_replace(' ', '_', $lieu) . '.pdf');
    }

    /**
     * PDF — Rapport global tous les agents
     */
    public function rapportGlobal()
    {
        $agents = Agent::orderBy('lieu_affectation')
                       ->orderBy('nom')
                       ->get();

        $pdf = Pdf::loadView('rapports.rapport_global', compact('agents'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('rapport_global_' . date('Y') . '.pdf');
    }
}
