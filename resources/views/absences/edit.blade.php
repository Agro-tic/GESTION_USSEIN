@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-pencil-square" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Absences</p>
        <h1 class="h3 mb-1">Modifier l'Absence</h1>
        <p class="text-muted mb-0">Modifiez les informations de l'absence</p>
      </div>
    </div>
  </div>

  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
      <strong>Veuillez corriger les erreurs suivantes :</strong>
      <ul class="mb-0 mt-1">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <section class="panel">
    <form action="{{ route('absence.update', $absence->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="row g-3">

        <div class="col-md-6">
          <label for="agent_id" class="form-label fw-semibold">Agent</label>
          <select class="form-select" name="agent_id" id="agent_id" required>
            <option value="">-- Sélectionner un agent --</option>
            @foreach($agents as $agent)
              <option value="{{ $agent->id }}" {{ old('agent_id', $absence->agent_id) == $agent->id ? 'selected' : '' }}>
                {{ $agent->nom }} {{ $agent->prenom }} — {{ $agent->matricule }}
              </option>
            @endforeach
          </select>
          @error('agent_id')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-6">
          <label for="motif" class="form-label fw-semibold">Motif</label>
          <input class="form-control" type="text" name="motif" id="motif"
                 value="{{ old('motif', $absence->motif) }}" required>
          @error('motif')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-4">
          <label for="date_debut" class="form-label fw-semibold">Date début</label>
          <input class="form-control" type="date" name="date_debut" id="date_debut"
                 value="{{ old('date_debut', \Carbon\Carbon::parse($absence->date_debut)->format('Y-m-d')) }}" required>
          @error('date_debut')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-4">
          <label for="date_fin" class="form-label fw-semibold">Date fin</label>
          <input class="form-control" type="date" name="date_fin" id="date_fin"
                 value="{{ old('date_fin', \Carbon\Carbon::parse($absence->date_fin)->format('Y-m-d')) }}" required>
          @error('date_fin')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-4">
          <label class="form-label fw-semibold">Nombre de jours</label>
          <input class="form-control bg-light" type="text"
                 value="{{ $absence->nb_jours }} jour(s)" readonly>
          <small class="text-muted">Recalculé automatiquement à la modification</small>
        </div>

        <div class="col-md-6">
          <label for="type_absence" class="form-label fw-semibold">Type d'absence</label>
          <select class="form-select" name="type_absence" id="type_absence" required>
            <option value="">-- Sélectionner --</option>
            <option value="ordinaire" {{ old('type_absence', $absence->type_absence) == 'ordinaire' ? 'selected' : '' }}>
              Ordinaire (défalquée)
            </option>
            <option value="exceptionnelle" {{ old('type_absence', $absence->type_absence) == 'exceptionnelle' ? 'selected' : '' }}>
              Exceptionnelle (non défalquée)
            </option>
          </select>
          @error('type_absence')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

      </div>

      <hr class="my-4">
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">Modifier</button>
        <a href="{{ route('absence.index') }}" class="btn btn-secondary">Annuler</a>
      </div>

    </form>
  </section>

</div>
@endsection
