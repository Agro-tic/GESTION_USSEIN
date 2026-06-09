<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Rapport — {{ $lieu }}</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 11px; color: #333; }
    h1 { font-size: 16px; color: #1a237e; border-bottom: 2px solid #1a237e; padding-bottom: 5px; }
    table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    th { background: #1a237e; color: white; padding: 6px 8px; text-align: left; font-size: 10px; }
    td { padding: 5px 8px; border-bottom: 1px solid #ddd; }
    tr:nth-child(even) { background: #f5f5f5; }
    .header { text-align: center; margin-bottom: 20px; }
    .footer { margin-top: 30px; font-size: 10px; color: #999; text-align: center; }
  </style>
</head>
<body>

  <div class="header">
    <h1>RAPPORT DES CONGÉS — {{ strtoupper($lieu) }}</h1>
    <p>Université — Service des Ressources Humaines — {{ date('d/m/Y') }}</p>
  </div>

  <table>
    <thead>
      <tr>
        <th>Nom & Prénom</th>
        <th>Matricule</th>
        <th>Prise service</th>
        <th>Sexe</th>
        <th>Enfants</th>
        <th>Congés N-1</th>
        <th>Congés N</th>
        <th>Jours dus</th>
        <th>Absences déf.</th>
        <th>Jours restants</th>
        <th>Statut</th>
      </tr>
    </thead>
    <tbody>
      @forelse($agents as $agent)
      <tr>
        <td>{{ strtoupper($agent->nom) }} {{ $agent->prenom }}</td>
        <td>{{ $agent->matricule }}</td>
        <td>{{ \Carbon\Carbon::parse($agent->date_prise_service)->format('d/m/Y') }}</td>
        <td>{{ $agent->sexe }}</td>
        <td>{{ $agent->nb_enfants }}</td>
        <td>{{ $agent->jours_conges_annee_precedente }}</td>
        <td>{{ $agent->jours_conges_annee_courante }}</td>
        <td><strong>{{ $agent->jours_conges_dus }}</strong></td>
        <td>{{ $agent->absences_defalquer }}</td>
        <td><strong>{{ $agent->jours_restants }}</strong></td>
        <td>{{ $agent->actif ? 'Actif' : 'Inactif' }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="11" style="text-align:center">Aucun agent pour ce lieu.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <div class="footer">
    Document généré le {{ date('d/m/Y à H:i') }} — BiblioConge · Université
  </div>

</body>
</html>
