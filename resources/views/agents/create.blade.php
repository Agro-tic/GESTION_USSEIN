@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  {{-- En-tête de page --}}
  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-person-plus" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Agents</p>
        <h1 class="h3 mb-1">Ajouter un nouvel Agent</h1>
        <p class="text-muted mb-0">Remplissez les informations pour enregistrer un nouvel agent.</p>
      </div>
    </div>
  </div>

  <section class="panel">
    <form action="{{ route('agent.store') }}" method="POST">
      @csrf

      {{-- Informations personnelles --}}
      <h6 class="fw-bold text-muted mb-3 text-uppercase small">
        <i class="bi bi-person me-1"></i> Informations personnelles
      </h6>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label for="nom" class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
          <input class="form-control @error('nom') is-invalid @enderror"
                 type="text" name="nom" id="nom"
                 value="{{ old('nom') }}" placeholder="Ex : DIALLO" required>
          @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
          <label for="prenom" class="form-label fw-semibold">Prénom <span class="text-danger">*</span></label>
          <input class="form-control @error('prenom') is-invalid @enderror"
                 type="text" name="prenom" id="prenom"
                 value="{{ old('prenom') }}" placeholder="Ex : Mamadou" required>
          @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
          <label for="matricule" class="form-label fw-semibold">Matricule <span class="text-danger">*</span></label>
          <input class="form-control @error('matricule') is-invalid @enderror"
                 type="text" name="matricule" id="matricule"
                 value="{{ old('matricule') }}" placeholder="Ex : MAT-2026-001" required>
          @error('matricule')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-3">
          <label for="genre" class="form-label fw-semibold">Genre <span class="text-danger">*</span></label>
          <select class="form-select @error('genre') is-invalid @enderror" name="genre" id="genre" required>
            <option value="">-- Sélectionner --</option>
            <option value="M" {{ old('genre') == 'M' ? 'selected' : '' }}>Masculin</option>
            <option value="F" {{ old('genre') == 'F' ? 'selected' : '' }}>Féminin</option>
          </select>
          @error('genre')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-3">
          <label for="nb_enfants" class="form-label fw-semibold">Nombre d'enfants</label>
          <input class="form-control" type="number" name="nb_enfants" id="nb_enfants"
                 value="{{ old('nb_enfants', 0) }}" min="0">
          <div class="form-text">+1 jour/enfant pour les femmes (Règle 1)</div>
        </div>
      </div>

      <hr class="my-3">

      {{-- Informations professionnelles --}}
      <h6 class="fw-bold text-muted mb-3 text-uppercase small">
        <i class="bi bi-briefcase me-1"></i> Informations professionnelles
      </h6>
      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <label for="lieu_affectation" class="form-label fw-semibold">Lieu d'affectation <span class="text-danger">*</span></label>
          <input class="form-control @error('lieu_affectation') is-invalid @enderror"
                 type="text" name="lieu_affectation" id="lieu_affectation"
                 value="{{ old('lieu_affectation') }}" placeholder="Ex : Direction RH" required>
          @error('lieu_affectation')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-3">
          <label for="date_prise_service" class="form-label fw-semibold">Date de prise de service <span class="text-danger">*</span></label>
          <input class="form-control @error('date_prise_service') is-invalid @enderror"
                 type="date" name="date_prise_service" id="date_prise_service"
                 value="{{ old('date_prise_service') }}" required>
          @error('date_prise_service')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <div class="form-text">Min. 12 mois pour être éligible aux congés.</div>
        </div>
        <div class="col-md-3">
          <label for="actif" class="form-label fw-semibold">Statut</label>
          <select class="form-select" name="actif" id="actif">
            <option value="1" {{ old('actif', 1) == 1 ? 'selected' : '' }}>Actif</option>
            <option value="0" {{ old('actif') == 0 ? 'selected' : '' }}>Inactif</option>
          </select>
        </div>
      </div>

      <hr class="my-3">

      {{-- Droits à congés --}}
      <h6 class="fw-bold text-muted mb-3 text-uppercase small">
        <i class="bi bi-calendar-check me-1"></i> Droits à congés
      </h6>
      <div class="row g-3 mb-4">
        <div class="col-md-3">
          <label for="jours_conges_annee_precedente" class="form-label fw-semibold">Reliquat N-1</label>
          <input class="form-control" type="number" name="jours_conges_annee_precedente"
                 id="jours_conges_annee_precedente" value="{{ old('jours_conges_annee_precedente', 0) }}" min="0">
        </div>
        <div class="col-md-3">
          <label for="jours_conges_annee_courante" class="form-label fw-semibold">Congés N (par défaut 24)</label>
          <input class="form-control" type="number" name="jours_conges_annee_courante"
                 id="jours_conges_annee_courante" value="{{ old('jours_conges_annee_courante', 24) }}" min="0">
        </div>
        <div class="col-md-3">
          <label for="absences_defalquer" class="form-label fw-semibold">Absences défalquées</label>
          <input class="form-control" type="number" name="absences_defalquer"
                 id="absences_defalquer" value="{{ old('absences_defalquer', 0) }}" min="0">
          <div class="form-text">Calculé automatiquement via le module Absences.</div>
        </div>
        <div class="col-md-3">
          <label for="annee_courante" class="form-label fw-semibold">Année courante</label>
          <input class="form-control" type="number" name="annee_courante"
                 id="annee_courante" value="{{ old('annee_courante', date('Y')) }}" readonly>
        </div>
      </div>

      <div class="d-flex gap-2 mt-2">
        <button type="submit" class="btn btn-success">
          <i class="bi bi-check-lg me-1"></i> Enregistrer
        </button>
        <a href="{{ route('agent.index') }}" class="btn btn-secondary">
          <i class="bi bi-x-lg me-1"></i> Annuler
        </a>
      </div>
    </form>
  </section>

</div>
@endsection
