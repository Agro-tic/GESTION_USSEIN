@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-calendar-x" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Jours Fériés</p>
        <h1 class="h3 mb-1">Détail du Jour Férié</h1>
        <p class="text-muted mb-0">Informations complètes du jour férié</p>
      </div>
    </div>
  </div>

  <section class="panel">
    <div class="card-body">
      <p><strong>Nom :</strong> {{ $jourferie->nom }}</p>
      <p><strong>Date :</strong> {{ $jourferie->date }}</p>
      <p><strong>Année :</strong> {{ $jourferie->annee }}</p>
    </div>

    <div class="card-footer mt-3 d-flex gap-2">
      <a class="btn btn-primary" href="{{ route('jourferie.edit', $jourferie->id) }}">
        <i class="bi bi-pencil"></i> Modifier
      </a>
      <a class="btn btn-secondary" href="{{ route('jourferie.index') }}">
        <i class="bi bi-arrow-left"></i> Retour
      </a>
    </div>
  </section>

</div>
@endsection
