@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

    {{-- En-tête --}}
    <div class="page-heading mb-4">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-person" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Agents</p>
                <h1 class="h3 mb-1">Détail de l'Agent</h1>
                <p class="text-muted mb-0">Informations complètes de l'agent</p>
            </div>
        </div>
    </div>

    {{-- Contenu --}}
    <section class="panel">
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $agent->nom }}</p>
            <p><strong>Prénom :</strong> {{ $agent->prenom }}</p>
            <p><strong>Matricule :</strong> {{ $agent->matricule }}</p>
            <p><strong>Lieu affectation :</strong> {{ $agent->lieu_affectation }}</p>
            <p><strong>Date prise service :</strong> {{ $agent->date_prise_service }}</p>
            <p><strong>Genre :</strong> {{ $agent->genre }}</p>
            <p><strong>Nb enfants :</strong> {{ $agent->nb_enfants }}</p>
            <p><strong>Congés N-1 :</strong> {{ $agent->jours_conges_annee_precedente }}</p>
            <p><strong>Congés N :</strong> {{ $agent->jours_conges_annee_courante }}</p>
            <p><strong>Congés dus :</strong> {{ $agent->jours_conges_dus }}</p>
            <p><strong>Absences :</strong> {{ $agent->absences_defalquer }}</p>
            <p><strong>Jours restants :</strong> {{ $agent->jours_restants }}</p>
            <p><strong>Actif :</strong>
                @if($agent->actif)
                    <span class="badge bg-success">Actif</span>
                @else
                    <span class="badge bg-secondary">Inactif</span>
                @endif
            </p>
            <p><strong>Année :</strong> {{ $agent->annee_courante }}</p>
        </div>

        <div class="card-footer mt-3">
            <a class="btn btn-secondary" href="{{ route('agent.index') }}">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </section>

</div>
@endsection
