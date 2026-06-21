<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Fiche Agent — {{ $agent->nom }} {{ $agent->prenom }}</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
    h1 { font-size: 18px; color: #1a237e; border-bottom: 2px solid #1a237e; padding-bottom: 5px; }
    h2 { font-size: 14px; color: #1a237e; margin-top: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th { background: #1a237e; color: white; padding: 6px 8px; text-align: left; }
    td { padding: 5px 8px; border-bottom: 1px solid #ddd; }
    tr:nth-child(even) { background: #f5f5f5; }
    .info-grid { display: table; width: 100%; margin-bottom: 15px; }
    .info-row { display: table-row; }
    .info-label { display: table-cell; font-weight: bold; width: 40%; padding: 4px 0; }
    .info-value { display: table-cell; padding: 4px 0; }
    .badge-success { background: #28a745; color: white; padding: 2px 6px; border-radius: 3px; }
    .badge-danger  { background: #dc3545; color: white; padding: 2px 6px; border-radius: 3px; }
    .badge-warning { background: #ffc107; color: #333; padding: 2px 6px; border-radius: 3px; }
    .header { text-align: center; margin-bottom: 20px; }
    .footer { margin-top: 30px; font-size: 10px; color: #999; text-align: center; }
  </style>
</head>
<body>

  <div class="header">
    <h1>FICHE INDIVIDUELLE DE CONGÉ</h1>
    <p>Université — Service des Ressources Humaines — {{ date('d/m/Y') }}</p>
  </div>

  <h2>Informations personnelles</h2>
  <div class="info-grid">
    <div class="info-row">
      <div class="info-label">Nom complet :</div>
      <div class="info-value">{{ strtoupper($agent->nom) }} {{ $agent->prenom }}</div>
    </div>
    <div class="info-row">
      <div class="info-label">Matricule :</div>
      <div class="info-value">{{ $agent->matricule }}</div>
    </div>
    <div class="info-row">
      <div class="info-label">Lieu d'affectation :</div>
      <div class="info-value">{{ $agent->lieu_affectation }}</div>
    </div>
    <div class="info-row">
      <div class="info-label">Date de prise de service :</div>
      <div class="info-value">{{ \Carbon\Carbon::parse($agent->date_prise_service)->format('d/m/Y') }}</div>
    </div>
    <div class="info-row">
      <div class="info-label">Sexe :</div>
      <div class="info-value">{{ $agent->sexe === 'M' ? 'Masculin' : 'Féminin' }}</div>
    </div>
    <div class="info-row">
      <div class="info-label">Nombre d'enfants :</div>
      <div class="info-value">{{ $agent->nb_enfants }}</div>
    </div>
  </div>

  <h2>Droits aux congés — {{ date('Y') }}</h2>
  <div class="info-grid">
    <div class="info-row">
      <div class="info-label">Reliquat N-1 :</div>
      <div class="info-value">{{ $agent->jours_conges_annee_precedente }} jours</div>
    </div>
    <div class="info-row">
      <div class="info-label">Congés année N :</div>
      <div class="info-value">{{ $agent->jours_conges_annee_courante }} jours</div>
    </div>
    <div class="info-row">
      <div class="info-label">Absences défalquées :</div>
      <div class="info-value">{{ $agent->absences_defalquer }} jours</div>
    </div>
    <div class="info-row">
      <div class="info-label">Total jours dus :</div>
      <div class="info-value"><strong>{{ $agent->jours_conges_dus }} jours</strong></div>
    </div>
    <div class="info-row">
      <div class="info-label">Jours restants :</div>
      <div class="info-value"><strong>{{ $agent->jours_restants }} jours</strong></div>
    </div>
  </div>

  <h2>Historique des congés</h2>
  @if($conges->count() > 0)
  <table>
    <thead>
      <tr>
        <th>Date cessation</th>
        <th>Date reprise</th>
        <th>Jours pris</th>
        <th>Statut</th>
      </tr>
    </thead>
    <tbody>
      @foreach($conges as $conge)
      <tr>
        <td>{{ \Carbon\Carbon::parse($conge->date_cessation)->format('d/m/Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($conge->date_reprise)->format('d/m/Y') }}</td>
        <td>{{ $conge->jours_a_prendre }}</td>
        <td>
          @if($conge->statut === 'approuve')
            <span class="badge-success">Approuvé</span>
          @elseif($conge->statut === 'refuse')
            <span class="badge-danger">Refusé</span>
          @else
            <span class="badge-warning">En attente</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @else
    <p>Aucun congé enregistré pour cet agent.</p>
  @endif

  <h2>Historique des absences</h2>
  @if($absences->count() > 0)
  <table>
    <thead>
      <tr>
        <th>Date début</th>
        <th>Date fin</th>
        <th>Nb jours</th>
        <th>Motif</th>
        <th>Type</th>
      </tr>
    </thead>
    <tbody>
      @foreach($absences as $absence)
      <tr>
        <td>{{ \Carbon\Carbon::parse($absence->date_debut)->format('d/m/Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($absence->date_fin)->format('d/m/Y') }}</td>
        <td>{{ $absence->nb_jours }}</td>
        <td>{{ $absence->motif }}</td>
        <td>{{ $absence->type_absence === 'ordinaire' ? 'Ordinaire' : 'Exceptionnelle' }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @else
    <p>Aucune absence enregistrée pour cet agent.</p>
  @endif

  <div class="footer">
    Document généré le {{ date('d/m/Y à H:i') }} — BiblioConge · Université
  </div>

</body>
</html>
