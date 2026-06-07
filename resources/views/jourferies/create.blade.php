@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  {{-- En-tête de page --}}
  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-calendar-plus" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Jours Fériés</p>
        <h1 class="h3 mb-1">Ajouter un Jour Férié</h1>
        <p class="text-muted mb-0">Remplissez les informations pour enregistrer un nouveau jour férié</p>
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
    <form action="{{ route('jourferie.store') }}" method="POST">
      @csrf

      <div class="row g-3">

        <div class="col-md-6">
          <label for="nom" class="form-label fw-semibold">Nom du jour férié</label>
          <input class="form-control" type="text" name="nom" id="nom"
                 value="{{ old('nom') }}" placeholder="Ex: Fête de l'indépendance" required>
          @error('nom')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-3">
          <label for="date" class="form-label fw-semibold">Date</label>
          <input class="form-control" type="date" name="date" id="date"
                 value="{{ old('date') }}" required>
          @error('date')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-3">
          <label for="annee" class="form-label fw-semibold">Année</label>
          <input class="form-control bg-light" type="number" name="annee" id="annee"
                 value="{{ old('annee', date('Y')) }}" readonly>
          <small class="text-muted">Extraite automatiquement de la date</small>
        </div>

      </div>{{-- fin row --}}

      <hr class="my-4">
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">+ Enregistrer</button>
        <a href="{{ route('jourferie.index') }}" class="btn btn-secondary">Annuler</a>
      </div>

    </form>
  </section>

</div>
@endsection
