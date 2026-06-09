<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Conge;
use App\Models\Absence;
use App\Models\Jourferie;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Nombre total d'agents
        $totalAgents = Agent::count();

        // Congés en attente
        $congesEnAttente = Conge::where('statut', 'en_attente')->count();

        // Absences ce mois
        $absencesMois = Absence::whereMonth('date_debut', Carbon::now()->month)
                               ->whereYear('date_debut', Carbon::now()->year)
                               ->count();

        // Jours fériés cette année
        $joursFeriesAnnee = Jourferie::where('annee', date('Y'))->count();

        // 5 derniers congés
        $derniersConges = Conge::with('agent')
                               ->orderBy('created_at', 'desc')
                               ->limit(5)
                               ->get();

        // 5 dernières absences
        $dernieresAbsences = Absence::with('agent')
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get();

        return view('dashboard', compact(
            'totalAgents',
            'congesEnAttente',
            'absencesMois',
            'joursFeriesAnnee',
            'derniersConges',
            'dernieresAbsences'
        ));
    }
}
