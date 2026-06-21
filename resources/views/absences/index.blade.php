@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-person-dash" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Absences</p>
        <h1 class="h3 mb-1">Liste des Absences</h1>
        <p class="text-muted mb-0">Consultez et gérez toutes les absences enregistrées.</p>
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
            <th>Date début</th>
            <th>Date fin</th>
            <th>Nb jours</th>
            <th>Motif</th>
            <th>Type</th>
            <th>Défalquable</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($absences as $item)
          <tr>
            <td>{{ $item->agent->nom }} {{ $item->agent->prenom }}</td>
            <td>{{ \Carbon\Carbon::parse($item->date_debut)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($item->date_fin)->format('d/m/Y') }}</td>
            <td>{{ $item->nb_jours }}</td>
            <td>{{ $item->motif }}</td>
            <td>
              @if($item->type_absence === 'ordinaire')
                <span class="badge bg-warning text-dark">Ordinaire</span>
              @else
                <span class="badge bg-info text-dark">Exceptionnelle</span>
              @endif
            </td>
            <td>
              @if($item->est_defalquable)
                <span class="badge bg-danger">Oui</span>
              @else
                <span class="badge bg-success">Non</span>
              @endif
            </td>
            <td>
              <div class="d-flex gap-1">
                <a class="btn btn-success btn-sm" href="{{ route('absence.show', $item->id) }}" title="Voir">
                  <i class="bi bi-eye"></i>
                </a>
                <a class="btn btn-primary btn-sm" href="{{ route('absence.edit', $item->id) }}" title="Modifier">
                  <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('absence.destroy', $item->id) }}" method="POST"
                  onsubmit="return confirm('Voulez-vous supprimer cette absence ?')">
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
            <td colspan="9" class="text-center text-muted py-4">
              <i class="bi bi-inbox fs-4 d-block mb-2"></i>
              Aucune absence enregistrée.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="px-3 pb-3">
      {{ $absences->links() }}
    </div>

  </section>

</div>
@endsection
