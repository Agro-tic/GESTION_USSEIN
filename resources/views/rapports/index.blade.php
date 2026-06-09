@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-file-earmark-pdf" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Rapports PDF</p>
        <h1 class="h3 mb-1">Génération de Rapports</h1>
        <p class="text-muted mb-0">Générez et téléchargez les rapports PDF.</p>
      </div>
    </div>
  </div>

  <div class="row g-4">

    {{-- Rapport Global --}}
    <div class="col-md-4">
      <section class="panel text-center py-4">
        <i class="bi bi-file-earmark-pdf fs-1 text-danger mb-3 d-block"></i>
        <h5 class="fw-bold">Rapport Global</h5>
        <p class="text-muted">Liste de tous les agents avec leurs droits aux congés.</p>
        <div class="mt-2 mb-3">
          <span class="badge bg-primary">{{ $totalAgents }} agents</span>
          <span class="badge bg-success ms-1">{{ $totalConges }} congés</span>
          <span class="badge bg-warning text-dark ms-1">{{ $totalAbsences }} absences</span>
        </div>
        <a href="{{ route('rapport.global') }}" class="btn btn-danger">
          <i class="bi bi-download me-1"></i> Télécharger PDF
        </a>
      </section>
    </div>

    {{-- Fiches Agents --}}
    <div class="col-md-8">
      <section class="panel">
        <h6 class="text-muted text-uppercase fw-bold mb-3">
          <i class="bi bi-person-badge me-1"></i> Fiches Agents Individuelles
        </h6>
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead class="table-dark">
              <tr>
                <th>Nom</th>
                <th>Matricule</th>
                <th>Lieu affectation</th>
                <th>Jours dus</th>
                <th>Jours restants</th>
                <th>Fiche PDF</th>
              </tr>
            </thead>
            <tbody>
              @forelse(App\Models\Agent::orderBy('nom')->get() as $agent)
              <tr>
                <td>{{ $agent->nom }} {{ $agent->prenom }}</td>
                <td><code>{{ $agent->matricule }}</code></td>
                <td>{{ $agent->lieu_affectation }}</td>
                <td>{{ $agent->jours_conges_dus }}</td>
                <td>
                  <span class="badge {{ $agent->jours_restants > 0 ? 'bg-success' : 'bg-danger' }}">
                    {{ $agent->jours_restants }} j
                  </span>
                </td>
                <td>
                  <a href="{{ route('rapport.agent', $agent->id) }}" class="btn btn-danger btn-sm">
                    <i class="bi bi-download"></i> PDF
                  </a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center text-muted py-3">
                  Aucun agent enregistré.
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </section>
    </div>

    {{-- Rapports par lieu d'affectation --}}
    <div class="col-md-12">
      <section class="panel">
        <h6 class="text-muted text-uppercase fw-bold mb-3">
          <i class="bi bi-building me-1"></i> Rapports par Lieu d'Affectation
        </h6>
        <div class="row g-3">
          @forelse($lieux as $lieu)
          <div class="col-md-3">
            <div class="border rounded p-3 text-center">
              <i class="bi bi-building fs-3 text-primary d-block mb-2"></i>
              <div class="fw-semibold">{{ $lieu }}</div>
              <div class="text-muted small mb-3">
                {{ App\Models\Agent::where('lieu_affectation', $lieu)->count() }} agent(s)
              </div>
              <a href="{{ route('rapport.lieu', $lieu) }}" class="btn btn-danger btn-sm">
                <i class="bi bi-download me-1"></i> PDF
              </a>
            </div>
          </div>
          @empty
          <div class="col-12 text-center text-muted py-3">
            Aucun lieu d'affectation enregistré.
          </div>
          @endforelse
        </div>
      </section>
    </div>

  </div>

</div>
@endsection
