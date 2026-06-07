@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Agents</p>
        <h1 class="h3 mb-1">Liste des Agents</h1>
        <p class="text-muted mb-0">Consultez et gérez tous les agents enregistrés.</p>
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
            <th>Nom</th>
            <th>Prénom</th>
            <th>Matricule</th>
            <th>Lieu affectation</th>
            <th>Date prise service</th>
            <th>Sexe</th>
            <th>Nb enfants</th>
            <th>Congés N-1</th>
            <th>Congés N</th>
            <th>Congés dus</th>
            <th>Absences</th>
            <th>Jours restants</th>
            <th>Actif</th>
            <th>Année</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($agents as $item)
          <tr>
            <td><a href="#">{{ $item->nom }}</a></td>
            <td>{{ $item->prenom }}</td>
            <td>{{ $item->matricule }}</td>
            <td>{{ $item->lieu_affectation }}</td>
            <td>{{ $item->date_prise_service }}</td>
            <td>{{ $item->sexe }}</td>
            <td>{{ $item->nb_enfants }}</td>
            <td>{{ $item->jours_conges_annee_precedente }}</td>
            <td>{{ $item->jours_conges_annee_courante }}</td>
            <td>{{ $item->jours_conges_dus }}</td>
            <td>{{ $item->absences_defalquer }}</td>
            <td>{{ $item->jours_restants }}</td>
            <td>
              @if($item->actif)
                <span class="badge bg-success">Actif</span>
              @else
                <span class="badge bg-secondary">Inactif</span>
              @endif
            </td>
            <td>{{ $item->annee_courante }}</td>
            <td>
              <div class="d-flex gap-1">
                <a class="btn btn-success btn-sm" href="{{ route('agent.show', $item->id) }}" title="Information">
                  <i class="bi bi-eye"></i>
                </a>
                <a class="btn btn-primary btn-sm" href="{{ route('agent.edit', $item->id) }}" title="Modifier">
                  <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('agent.destroy', $item->id) }}" method="POST"
                  onsubmit="return confirm('Voulez-vous supprimer cet agent ?')">
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
            <td colspan="15" class="text-center text-muted py-4">
              <i class="bi bi-inbox fs-4 d-block mb-2"></i>
              Aucun agent enregistré.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="px-3 pb-3">
      {{ $agents->links() }}
    </div>

  </section>

</div>
@endsection
