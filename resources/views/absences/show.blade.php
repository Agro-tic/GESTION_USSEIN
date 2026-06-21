@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-person-dash" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Absences</p>
        <h1 class="h3 mb-1">Détail de l'Absence</h1>
        <p class="text-muted mb-0">Informations complètes de l'absence</p>
      </div>
    </div>
  </div>

  <section class="panel">
    <div class="card-body">
      <p><strong>Agent :</strong> {{ $absence->agent->nom }} {{ $absence->agent->prenom }}</p>
      <p><strong>Matricule :</strong> {{ $absence->agent->matricule }}</p>
      <p><strong>Motif :</strong> {{ $absence->motif }}</p>
      <p><strong>Date début :</strong> {{ \Carbon\Carbon::parse($absence->date_debut)->format('d/m/Y') }}</p>
      <p><strong>Date fin :</strong> {{ \Carbon\Carbon::parse($absence->date_fin)->format('d/m/Y') }}</p>
      <p><strong>Nombre de jours :</strong> {{ $absence->nb_jours }}</p>
      <p><strong>Type :</strong>
        @if($absence->type_absence === 'ordinaire')
          <span class="badge bg-warning text-dark">Ordinaire</span>
        @else
          <span class="badge bg-info text-dark">Exceptionnelle</span>
        @endif
      </p>
      <p><strong>Défalquable :</strong>
        @if($absence->est_defalquable)
          <span class="badge bg-danger">Oui — déduite des congés</span>
        @else
          <span class="badge bg-success">Non — ne réduit pas les congés</span>
        @endif
      </p>
    </div>

    <div class="card-footer mt-3 d-flex gap-2">
      <a class="btn btn-primary" href="{{ route('absence.edit', $absence->id) }}">
        <i class="bi bi-pencil"></i> Modifier
      </a>
      <a class="btn btn-secondary" href="{{ route('absence.index') }}">
        <i class="bi bi-arrow-left"></i> Retour
      </a>
    </div>
  </section>

</div>
@endsection
