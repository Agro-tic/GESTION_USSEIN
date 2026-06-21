@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-pencil-square" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Agents</p>
        <h1 class="h3 mb-1">Modifier l'Agent</h1>
        <p class="text-muted mb-0">Modifiez les informations de l'agent</p>
      </div>
    </div>
  </div>

  {{-- Erreurs de validation --}}
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
    <form action="{{ route('agent.update', $agent->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="row g-3">

        <div class="col-md-6">
          <label for="nom" class="form-label fw-semibold">Nom</label>
          <input class="form-control" type="text" name="nom" id="nom"
                 value="{{ old('nom', $agent->nom) }}" required>
        </div>

        <div class="col-md-6">
          <label for="prenom" class="form-label fw-semibold">Prénom</label>
          <input class="form-control" type="text" name="prenom" id="prenom"
                 value="{{ old('prenom', $agent->prenom) }}" required>
        </div>

        <div class="col-md-6">
          <label for="matricule" class="form-label fw-semibold">Matricule</label>
          <input class="form-control" type="text" name="matricule" id="matricule"
                 value="{{ old('matricule', $agent->matricule) }}" required>
          @error('matricule')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-6">
          <label for="lieu_affectation" class="form-label fw-semibold">Lieu affectation</label>
          <input class="form-control" type="text" name="lieu_affectation" id="lieu_affectation"
                 value="{{ old('lieu_affectation', $agent->lieu_affectation) }}" required>
        </div>

        <div class="col-md-6">
          <label for="date_prise_service" class="form-label fw-semibold">Date de prise de service</label>
          <input class="form-control" type="date" name="date_prise_service" id="date_prise_service"
                 value="{{ old('date_prise_service', $agent->date_prise_service) }}" required>
        </div>

        <div class="col-md-6">
          <label for="sexe" class="form-label fw-semibold">Sexe</label>
          <select class="form-select" name="sexe" id="sexe" required>
            <option value="">-- Sélectionner --</option>
            <option value="M" {{ old('sexe', $agent->sexe) == 'M' ? 'selected' : '' }}>Masculin</option>
            <option value="F" {{ old('sexe', $agent->sexe) == 'F' ? 'selected' : '' }}>Féminin</option>
          </select>
        </div>

        <div class="col-md-6">
          <label for="nb_enfants" class="form-label fw-semibold">Nombre d'enfants</label>
          <input class="form-control" type="number" name="nb_enfants" id="nb_enfants"
                 value="{{ old('nb_enfants', $agent->nb_enfants) }}" min="0" required>
        </div>

        <div class="col-md-6">
          <label for="jours_conges_annee_precedente" class="form-label fw-semibold">Congés année précédente</label>
          <input class="form-control" type="number" name="jours_conges_annee_precedente" id="jours_conges_annee_precedente"
                 value="{{ old('jours_conges_annee_precedente', $agent->jours_conges_annee_precedente) }}" min="0" required>
        </div>

        <div class="col-md-6">
          <label for="jours_conges_annee_courante" class="form-label fw-semibold">Congés année courante</label>
          <input class="form-control" type="number" name="jours_conges_annee_courante" id="jours_conges_annee_courante"
                 value="{{ old('jours_conges_annee_courante', $agent->jours_conges_annee_courante) }}" min="0" required>
        </div>

        <div class="col-md-6">
          <label for="absences_defalquer" class="form-label fw-semibold">Absences défalquées</label>
          <input class="form-control" type="number" name="absences_defalquer" id="absences_defalquer"
                 value="{{ old('absences_defalquer', $agent->absences_defalquer) }}" min="0" required>
        </div>

        <div class="col-md-6">
          <label for="actif" class="form-label fw-semibold">Statut</label>
          <select class="form-control" name="actif" id="actif" required>
            <option value="1" {{ old('actif', $agent->actif) == 1 ? 'selected' : '' }}>Actif</option>
            <option value="0" {{ old('actif', $agent->actif) == 0 ? 'selected' : '' }}>Inactif</option>
          </select>
        </div>

        <div class="col-md-6">
          <label for="annee_courante" class="form-label fw-semibold">Année courante</label>
          <input class="form-control" type="number" name="annee_courante" id="annee_courante"
                 value="{{ old('annee_courante', $agent->annee_courante) }}" readonly required>
        </div>

      </div>{{-- fin row --}}

      <hr class="my-4">
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">Modifier</button>
        <a href="{{ route('agent.index') }}" class="btn btn-secondary">Annuler</a>
      </div>

    </form>
  </section>

</div>
@endsection
