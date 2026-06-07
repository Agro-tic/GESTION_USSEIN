@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-calendar-x" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Jours Fériés</p>
        <h1 class="h3 mb-1">Liste des Jours Fériés</h1>
        <p class="text-muted mb-0">Consultez et gérez les jours fériés du calendrier sénégalais.</p>
      </div>
    </div>
    <a href="{{ route('jourferie.create') }}" class="btn btn-success">
      <i class="bi bi-plus-circle me-1"></i> Nouveau Jour Férié
    </a>
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
            <th>Nom</th>
            <th>Date</th>
            <th>Année</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($jourferies as $item)
          <tr>
            <td>{{ $item->nom }}</td>
            <td>{{ $item->date }}</td>
            <td>{{ $item->annee }}</td>
            <td>
              <div class="d-flex gap-1">
                <a class="btn btn-success btn-sm" href="{{ route('jourferie.show', $item->id) }}" title="Voir">
                  <i class="bi bi-eye"></i>
                </a>
                <a class="btn btn-primary btn-sm" href="{{ route('jourferie.edit', $item->id) }}" title="Modifier">
                  <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('jourferie.destroy', $item->id) }}" method="POST"
                  onsubmit="return confirm('Voulez-vous supprimer ce jour férié ?')">
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
            <td colspan="5" class="text-center text-muted py-4">
              <i class="bi bi-inbox fs-4 d-block mb-2"></i>
              Aucun jour férié enregistré.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="px-3 pb-3">
      {{ $jourferies->links() }}
    </div>

  </section>

</div>
@endsection
