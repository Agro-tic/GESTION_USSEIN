@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-calendar-check" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Congés</p>
        <h1 class="h3 mb-1">Liste des Congés</h1>
        <p class="text-muted mb-0">Consultez et gérez tous les congés enregistrés.</p>
      </div>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <section class="panel">
    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>Agent</th>
            <th>Date cessation</th>
            <th>Date reprise</th>
            <th>Jours à prendre</th>
            <th>Jours restants</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($conges as $item)
          <tr>
            <td>{{ $item->agent->nom }} {{ $item->agent->prenom }}</td>
            <td>{{ \Carbon\Carbon::parse($item->date_cessation)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($item->date_reprise)->format('d/m/Y') }}</td>
            <td>{{ $item->jours_a_prendre }}</td>
            <td>
              <span class="badge {{ $item->jours_restants > 0 ? 'bg-success' : 'bg-danger' }}">
                {{ $item->jours_restants }} j
              </span>
            </td>
            <td>
              @if($item->statut === 'approuve')
                <span class="badge bg-success">Approuvé</span>
              @elseif($item->statut === 'refuse')
                <span class="badge bg-danger">Refusé</span>
              @else
                <span class="badge bg-warning text-dark">En attente</span>
              @endif
            </td>
            <td>
              <div class="d-flex gap-1">
                <a class="btn btn-success btn-sm" href="{{ route('conge.show', $item->id) }}" title="Voir">
                  <i class="bi bi-eye"></i>
                </a>
                <a class="btn btn-primary btn-sm" href="{{ route('conge.edit', $item->id) }}" title="Modifier">
                  <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('conge.destroy', $item->id) }}" method="POST"
                  onsubmit="return confirm('Voulez-vous supprimer ce congé ?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" type="submit" title="Supprimer">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-center text-muted py-4">
              <i class="bi bi-inbox fs-4 d-block mb-2"></i>
              Aucun congé enregistré.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="px-3 pb-3">
      {{ $conges->links() }}
    </div>

  </section>

</div>
@endsection
