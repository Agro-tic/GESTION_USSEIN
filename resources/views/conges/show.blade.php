@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-calendar-check" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Congés</p>
        <h1 class="h3 mb-1">Détail du Congé</h1>
        <p class="text-muted mb-0">Informations complètes du congé</p>
      </div>
    </div>
  </div>

  <section class="panel">
    <div class="card-body">
      <p><strong>Agent :</strong> {{ $conge->agent->nom }} {{ $conge->agent->prenom }}</p>
      <p><strong>Matricule :</strong> {{ $conge->agent->matricule }}</p>
      <p><strong>Date de cessation :</strong> {{ \Carbon\Carbon::parse($conge->date_cessation)->format('d/m/Y') }}</p>
      <p><strong>Date de reprise :</strong> {{ \Carbon\Carbon::parse($conge->date_reprise)->format('d/m/Y') }}</p>
      <p><strong>Jours à prendre :</strong> {{ $conge->jours_a_prendre }}</p>
      <p><strong>Jours restants :</strong>
        <span class="badge {{ $conge->jours_restants > 0 ? 'bg-success' : 'bg-danger' }}">
          {{ $conge->jours_restants }} j
        </span>
      </p>
      <p><strong>Statut :</strong>
        @if($conge->statut === 'approuve')
          <span class="badge bg-success">Approuvé</span>
        @elseif($conge->statut === 'refuse')
          <span class="badge bg-danger">Refusé</span>
        @else
          <span class="badge bg-warning text-dark">En attente</span>
        @endif
      </p>
    </div>

    <div class="card-footer mt-3 d-flex gap-2">
      <a class="btn btn-primary" href="{{ route('conge.edit', $conge->id) }}">
        <i class="bi bi-pencil"></i> Modifier
      </a>
      <a class="btn btn-secondary" href="{{ route('conge.index') }}">
        <i class="bi bi-arrow-left"></i> Retour
      </a>
    </div>
  </section>

</div>
@endsection
