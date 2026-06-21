<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Rapport Global — {{ date('Y') }}</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 10px; color: #333; }
    h1 { font-size: 16px; color: #1a237e; border-bottom: 2px solid #1a237e; padding-bottom: 5px; }
    h2 { font-size: 12px; color: #1a237e; margin-top: 15px; background: #e8eaf6; padding: 4px 8px; }
    table { width: 100%; border-collapse: collapse; margin-top: 5px; }
    th { background: #1a237e; color: white; padding: 5px 6px; text-align: left; font-size: 9px; }
    td { padding: 4px 6px; border-bottom: 1px solid #ddd; }
    tr:nth-child(even) { background: #f5f5f5; }
    .header { text-align: center; margin-bottom: 20px; }
    .footer { margin-top: 30px; font-size: 9px; color: #999; text-align: center; }
  </style>
</head>
<body>

  <div class="header">
    <h1>RAPPORT GLOBAL DES CONGÉS — {{ date('Y') }}</h1>
    <p>Université — Service des Ressources Humaines — {{ date('d/m/Y') }}</p>
    <p>Total agents : <strong>{{ $agents->count() }}</strong></p>
  </div>

  @php $lieux = $agents->groupBy('lieu_affectation'); @endphp

  @foreach($lieux as $lieu => $agentsLieu)
  <h2>{{ strtoupper($lieu) }} ({{ $agentsLieu->count() }} agent(s))</h2>
  <table>
    <thead>
      <tr>
        <th>Nom & Prénom</th>
        <th>Matricule</th>
        <th>Prise service</th>
        <th>Sexe</th>
        <th>Enfants</th>
        <th>Jours dus</th>
        <th>Absences déf.</th>
        <th>Jours restants</th>
        <th>Statut</th>
      </tr>
    </thead>
    <tbody>
      @foreach($agentsLieu as $agent)
      <tr>
        <td>{{ strtoupper($agent->nom) }} {{ $agent->prenom }}</td>
        <td>{{ $agent->matricule }}</td>
        <td>{{ \Carbon\Carbon::parse($agent->date_prise_service)->format('d/m/Y') }}</td>
        <td>{{ $agent->sexe }}</td>
        <td>{{ $agent->nb_enfants }}</td>
        <td><strong>{{ $agent->jours_conges_dus }}</strong></td>
        <td>{{ $agent->absences_defalquer }}</td>
        <td><strong>{{ $agent->jours_restants }}</strong></td>
        <td>{{ $agent->actif ? 'Actif' : 'Inactif' }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endforeach

  <div class="footer">
    Document généré le {{ date('d/m/Y à H:i') }} — BiblioConge · Université
  </div>

</body>
</html>
