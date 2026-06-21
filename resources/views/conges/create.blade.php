@extends('layouts.template')

@section('contenu')
<div class="container-fluid px-3 px-lg-4 py-4">

  <div class="page-heading mb-4">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-calendar-plus" aria-hidden="true"></i></span>
      <div>
        <p class="eyebrow mb-1">Congés</p>
        <h1 class="h3 mb-1">Ajouter un Congé</h1>
        <p class="text-muted mb-0">Remplissez les informations pour enregistrer un nouveau congé</p>
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
    <form action="{{ route('conge.store') }}" method="POST">
      @csrf

      <div class="row g-3">

        <div class="col-md-6">
          <label for="agent_id" class="form-label fw-semibold">Agent</label>
          <select class="form-select" name="agent_id" id="agent_id" required>
            <option value="">-- Sélectionner un agent --</option>
            @foreach($agents as $agent)
              <option value="{{ $agent->id }}"
                {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                {{ $agent->nom }} {{ $agent->prenom }} — {{ $agent->matricule }}
                ({{ $agent->jours_conges_dus }} jours dus)
              </option>
            @endforeach
          </select>
          @error('agent_id')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-3">
          <label for="date_cessation" class="form-label fw-semibold">Date de cessation</label>
          <input class="form-control" type="date" name="date_cessation" id="date_cessation"
                 value="{{ old('date_cessation') }}" required>
          <small class="text-muted">Dernier jour de travail avant le congé</small>
          @error('date_cessation')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-3">
          <label for="jours_a_prendre" class="form-label fw-semibold">Jours à prendre</label>
          <input class="form-control" type="number" name="jours_a_prendre" id="jours_a_prendre"
                 value="{{ old('jours_a_prendre', 1) }}" min="1" max="72" required>
          @error('jours_a_prendre')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
          @enderror
        </div>

        <div class="col-md-3">
          <label for="date_reprise" class="form-label fw-semibold">Date de reprise</label>
          <input class="form-control bg-light" type="date" name="date_reprise" id="date_reprise"
                 value="{{ old('date_reprise') }}" readonly>
          <small class="text-muted">Calculée automatiquement</small>
        </div>

        <div class="col-md-3">
          <label for="statut" class="form-label fw-semibold">Statut</label>
          <select class="form-select" name="statut" id="statut">
            <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>
              En attente
            </option>
            <option value="approuve" {{ old('statut') == 'approuve' ? 'selected' : '' }}>
              Approuvé
            </option>
            <option value="refuse" {{ old('statut') == 'refuse' ? 'selected' : '' }}>
              Refusé
            </option>
          </select>
        </div>

      </div>

      <hr class="my-4">
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">+ Enregistrer</button>
        <a href="{{ route('conge.index') }}" class="btn btn-secondary">Annuler</a>
      </div>

    </form>
  </section>

</div>

<script>
  // Calcul automatique de la date de reprise côté client (indicatif)
  // Le calcul réel (avec jours fériés) est fait côté serveur
  function calculerDateReprise() {
    const cessation    = document.getElementById('date_cessation').value;
    const joursAPrendre = parseInt(document.getElementById('jours_a_prendre').value);

    if (!cessation || !joursAPrendre) return;

    let current = new Date(cessation);
    const jourSemaine = current.getDay(); // 0=dim, 5=ven

    // Règle 3 — si vendredi, décompte commence lundi
    if (jourSemaine === 5) {
      current.setDate(current.getDate() + 3);
    } else {
      current.setDate(current.getDate() + 1);
    }

    let joursComptes = 0;
    while (joursComptes < joursAPrendre) {
      // Sauter les dimanches
      if (current.getDay() === 0) {
        current.setDate(current.getDate() + 1);
        continue;
      }
      joursComptes++;
      if (joursComptes < joursAPrendre) {
        current.setDate(current.getDate() + 1);
      }
    }

    // Afficher la date calculée
    const yyyy = current.getFullYear();
    const mm   = String(current.getMonth() + 1).padStart(2, '0');
    const dd   = String(current.getDate()).padStart(2, '0');
    document.getElementById('date_reprise').value = `${yyyy}-${mm}-${dd}`;
  }

  document.getElementById('date_cessation').addEventListener('change', calculerDateReprise);
  document.getElementById('jours_a_prendre').addEventListener('input', calculerDateReprise);
</script>

@endsection
