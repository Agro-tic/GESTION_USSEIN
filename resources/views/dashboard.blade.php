@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Tableau de Bord</p>
        <h1 class="h3 mb-1">Vue d'ensemble</h1>
        <p class="text-muted mb-0">Statistiques globales de la gestion des congés et absences.</p>
      </div>
    </div>
  </div>

  {{-- Cartes statistiques --}}
  <div class="row g-4 mb-4">

    <div class="col-md-3">
      <div class="panel text-center py-4">
        <div class="fs-1 fw-bold text-primary">{{ $totalAgents }}</div>
        <div class="text-muted mt-1">
          <i class="bi bi-people me-1"></i> Agents
        </div>
        <a href="{{ route('agent.index') }}" class="btn btn-sm btn-outline-primary mt-3">
          Voir la liste
        </a>
      </div>
    </div>

    <div class="col-md-3">
      <div class="panel text-center py-4">
        <div class="fs-1 fw-bold text-warning">{{ $congesEnAttente }}</div>
        <div class="text-muted mt-1">
          <i class="bi bi-calendar-x me-1"></i> Congés en attente
        </div>
        <a href="{{ route('conge.index') }}" class="btn btn-sm btn-outline-warning mt-3">
          Voir la liste
        </a>
      </div>
    </div>

    <div class="col-md-3">
      <div class="panel text-center py-4">
        <div class="fs-1 fw-bold text-danger">{{ $absencesMois }}</div>
        <div class="text-muted mt-1">
          <i class="bi bi-person-dash me-1"></i> Absences ce mois
        </div>
        <a href="{{ route('absence.index') }}" class="btn btn-sm btn-outline-danger mt-3">
          Voir la liste
        </a>
      </div>
    </div>

    <div class="col-md-3">
      <div class="panel text-center py-4">
        <div class="fs-1 fw-bold text-success">{{ $joursFeriesAnnee }}</div>
        <div class="text-muted mt-1">
          <i class="bi bi-calendar-check me-1"></i> Jours fériés {{ date('Y') }}
        </div>
        <a href="{{ route('jourferie.index') }}" class="btn btn-sm btn-outline-success mt-3">
          Voir la liste
        </a>
      </div>
    </div>

  </div>

  <div class="row g-4">

    {{-- Derniers congés --}}
    <div class="col-md-6">
      <section class="panel">
        <h6 class="text-muted text-uppercase fw-bold mb-3">
          <i class="bi bi-calendar-check me-1"></i> Derniers Congés
        </h6>
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th>Agent</th>
                <th>Cessation</th>
                <th>Reprise</th>
                <th>Statut</th>
              </tr>
            </thead>
            <tbody>
              @forelse($derniersConges as $conge)
              <tr>
                <td>{{ $conge->agent->nom }} {{ $conge->agent->prenom }}</td>
                <td>{{ \Carbon\Carbon::parse($conge->date_cessation)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($conge->date_reprise)->format('d/m/Y') }}</td>
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
        <a href="{{ route('conge.index') }}" class="btn btn-sm btn-outline-primary mt-2">
          Voir tous les congés
        </a>
      </section>
    </div>

    {{-- Dernières absences --}}
    <div class="col-md-6">
      <section class="panel">
        <h6 class="text-muted text-uppercase fw-bold mb-3">
          <i class="bi bi-person-dash me-1"></i> Dernières Absences
        </h6>
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th>Agent</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              @forelse($dernieresAbsences as $absence)
              <tr>
                <td>{{ $absence->agent->nom }} {{ $absence->agent->prenom }}</td>
                <td>{{ \Carbon\Carbon::parse($absence->date_debut)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($absence->date_fin)->format('d/m/Y') }}</td>
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
                <td colspan="4" class="text-center text-muted py-3">
                  Aucune absence enregistrée.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <a href="{{ route('absence.index') }}" class="btn btn-sm btn-outline-danger mt-2">
          Voir toutes les absences
        </a>
      </section>
    </div>

  </div>

</div>
@endsection
