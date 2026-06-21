@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-clock-history" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Agents</p>
        <h1 class="h3 mb-1">Historique — {{ $agent->nom }} {{ $agent->prenom }}</h1>
        <p class="text-muted mb-0">Matricule : {{ $agent->matricule }} — {{ $agent->lieu_affectation }}</p>
      </div>
    </div>
    <a href="{{ route('agent.show', $agent->id) }}" class="btn btn-secondary">
      <i class="bi bi-arrow-left me-1"></i> Retour fiche
    </a>
  </div>

  {{-- Résumé des droits --}}
  <div class="row g-3 mb-4">
    <div class="col-md-3">
      <div class="panel text-center py-3">
        <div class="fs-3 fw-bold text-primary">{{ $agent->jours_conges_dus }}</div>
        <small class="text-muted">Jours dus</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel text-center py-3">
        <div class="fs-3 fw-bold text-danger">{{ $agent->absences_defalquer }}</div>
        <small class="text-muted">Absences défalquées</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel text-center py-3">
        <div class="fs-3 fw-bold text-warning">{{ $conges->count() }}</div>
        <small class="text-muted">Congés pris</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="panel text-center py-3">
        <div class="fs-3 fw-bold {{ $agent->jours_restants > 0 ? 'text-success' : 'text-danger' }}">
          {{ $agent->jours_restants }}
        </div>
        <small class="text-muted">Jours restants</small>
      </div>
    </div>
  </div>

  <div class="row g-4">

    {{-- Historique Congés --}}
    <div class="col-md-6">
      <section class="panel">
        <h6 class="text-muted text-uppercase fw-bold mb-3">
          <i class="bi bi-calendar-check me-1"></i> Historique des Congés
        </h6>
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th>Cessation</th>
                <th>Reprise</th>
                <th>Jours</th>
                <th>Statut</th>
              </tr>
            </thead>
            <tbody>
              @forelse($conges as $conge)
              <tr>
                <td>{{ \Carbon\Carbon::parse($conge->date_cessation)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($conge->date_reprise)->format('d/m/Y') }}</td>
                <td>{{ $conge->jours_a_prendre }}</td>
                <td>
                  @if($conge->statut === 'approuve')
                    <span class="badge bg-success">Approuvé</span>
                  @elseif($conge->statut === 'refuse')
                    <span class="badge bg-danger">Refusé</span>
                  @else
                    <span class="badge bg-warning text-dark">En attente</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center text-muted py-3">
                  Aucun congé enregistré.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </section>
    </div>

    {{-- Historique Absences --}}
    <div class="col-md-6">
      <section class="panel">
        <h6 class="text-muted text-uppercase fw-bold mb-3">
          <i class="bi bi-person-dash me-1"></i> Historique des Absences
        </h6>
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th>Début</th>
                <th>Fin</th>
                <th>Jours</th>
                <th>Motif</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              @forelse($absences as $absence)
              <tr>
                <td>{{ \Carbon\Carbon::parse($absence->date_debut)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($absence->date_fin)->format('d/m/Y') }}</td>
                <td>{{ $absence->nb_jours }}</td>
                <td>{{ $absence->motif }}</td>
                <td>
                  @if($absence->type_absence === 'ordinaire')
                    <span class="badge bg-warning text-dark">Ordinaire</span>
                  @else
                    <span class="badge bg-info text-dark">Exceptionnelle</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center text-muted py-3">
                  Aucune absence enregistrée.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </section>
    </div>

  </div>

</div>
@endsection
