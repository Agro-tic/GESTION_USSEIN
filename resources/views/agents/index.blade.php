@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  {{-- En-tête de page --}}
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

  {{-- Alertes --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Tableau --}}
  <section class="panel">
    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Matricule</th>
            <th>Lieu d'affectation</th>
            <th>Prise service</th>
            <th>Genre</th>
            <th>Enfants</th>
            <th>Congés N-1</th>
            <th>Congés dus</th>
            <th>Absences déduit.</th>
            <th>Jours restants</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($agents as $item)
          <tr>
            <td><a>{{ $item->nom }}</a></td>
            <td>{{ $item->prenom }}</td>
            <td><code>{{ $item->matricule }}</code></td>
            <td>{{ $item->lieu_affectation }}</td>
            <td>{{ \Carbon\Carbon::parse($item->date_prise_service)->format('d/m/Y') }}</td>
            <td>
              @if($item->genre === 'F')
                <span class="badge bg-pink text-white" style="background:#e91e8c!important">F</span>
              @else
                <span class="badge bg-primary">M</span>
              @endif
            </td>
            <td class>{{ $item->nb_enfants }}</td>
            <td class>{{ $item->jours_conges_annee_precedente }}</td>
            <td class>{{ $item->jours_conges_dus }}</td>
            <td class>{{ $item->absences_defalquer }}</td>
            <td class=>
              @php $restants = $item->jours_restants; @endphp
              <span class="badge {{ $restants > 10 ? 'bg-success' : ($restants > 0 ? 'bg-warning text-dark' : 'bg-danger') }}">
                {{ $restants }}
              </span>
            </td>
            <td>
              @if($item->actif)
                <span class="badge bg-success">Actif</span>
              @else
                <span class="badge bg-secondary">Inactif</span>
              @endif
            </td>
            <td>
              <div class="d-flex gap-1">
                <a class="btn btn-success btn-sm" href="{{ route('agent.show', $item->id) }}" title="Voir">
                  <i class="bi bi-eye"></i>
                </a>
                <a class="btn btn-primary btn-sm" href="{{ route('agent.edit', $item->id) }}" title="Modifier">
                  <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('agent.destroy', $item->id) }}" method="POST"
                      onsubmit="return confirm('Supprimer cet agent ?')">
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
            <td colspan="13" class="text-center text-muted py-5">
              <i class="bi bi-inbox fs-4 d-block mb-2"></i>
              Aucun agent enregistré. <a href="{{ route('agent.create') }}">Ajouter le premier</a>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="px-3 py-2">
      {{ $agents->links() }}
    </div>
  </section>

</div>
@endsection


