@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  {{-- En-tête --}}
  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Vue d'ensemble</p>
        <h1 class="h3 mb-1">Tableau de bord</h1>
        <p class="text-muted mb-0">Gestion des absences et congés du personnel — USSEIN</p>
      </div>
    </div>
  </div>

  {{-- Cartes statistiques --}}
  <div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="panel d-flex align-items-center gap-3 p-3">
        <span class="fs-2 text-primary"><i class="bi bi-people"></i></span>
        <div>
          <div class="text-muted small">Total Agents</div>
          <div class="fs-4 fw-bold">{{ $stats['total_agents'] }}</div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="panel d-flex align-items-center gap-3 p-3">
        <span class="fs-2 text-success"><i class="bi bi-person-check"></i></span>
        <div>
          <div class="text-muted small">Agents Actifs</div>
          <div class="fs-4 fw-bold">{{ $stats['agents_actifs'] }}</div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="panel d-flex align-items-center gap-3 p-3">
        <span class="fs-2 text-warning"><i class="bi bi-calendar-x"></i></span>
        <div>
          <div class="text-muted small">Congés en cours</div>
          <div class="fs-4 fw-bold">{{ $stats['conges_en_cours'] }}</div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="panel d-flex align-items-center gap-3 p-3">
        <span class="fs-2 text-danger"><i class="bi bi-person-dash"></i></span>
        <div>
          <div class="text-muted small">Absences ce mois</div>
          <div class="fs-4 fw-bold">{{ $stats['absences_mois'] }}</div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-3">
    {{-- Derniers congés --}}
    <div class="col-lg-6">
      <section class="panel">
        <div class="panel-header d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0"><i class="bi bi-calendar-x me-2"></i>Derniers Congés</h5>
          <a href="{{ route('conge.index') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
        </div>
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Agent</th>
                <th>Cessation</th>
                <th>Reprise</th>
                <th>Statut</th>
              </tr>
            </thead>
            <tbody>
              @forelse($derniers_conges as $conge)
              <tr>
                <td>{{ $conge->agent->nom }} {{ $conge->agent->prenom }}</td>
                <td>{{ $conge->date_cessation->format('d/m/Y') }}</td>
                <td>{{ $conge->date_reprise->format('d/m/Y') }}</td>
                <td>
                  @if($conge->statut === 'approuve')
                    <span class="badge bg-success">Approuvé</span>
                  @elseif($conge->statut === 'rejete')
                    <span class="badge bg-danger">Rejeté</span>
                  @else
                    <span class="badge bg-warning text-dark">En attente</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr><td colspan="4" class="text-center text-muted py-3">Aucun congé enregistré.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </section>
    </div>

    {{-- Dernières absences --}}
    <div class="col-lg-6">
      <section class="panel">
        <div class="panel-header d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0"><i class="bi bi-person-dash me-2"></i>Dernières Absences</h5>
          <a href="{{ route('absence.index') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
        </div>
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
                <th>Agent</th>
                <th>Début</th>
                <th>Jours</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              @forelse($dernieres_absences as $absence)
              <tr>
                <td>{{ $absence->agent->nom }} {{ $absence->agent->prenom }}</td>
                <td>{{ $absence->date_debut->format('d/m/Y') }}</td>
                <td>{{ $absence->nb_jours }}</td>
                <td>
                  @if($absence->type === 'ordinaire')
                    <span class="badge bg-secondary">Ordinaire</span>
                  @else
                    <span class="badge bg-info text-dark">Exceptionnelle</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr><td colspan="4" class="text-center text-muted py-3">Aucune absence enregistrée.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>

</div>
@endsection
