<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | Gestion des Absences et Congés</title>


  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>

    @include('layouts.sidebar')

    <div class="admin-main">

      @include('layouts.navbar')

      <main class="dashboard-content">
        @yield('contenu')
      </main>

      <footer class="admin-footer">
        <div class="container-fluid px-3 px-lg-4">
          <span>Copyright 2026 &mdash; Plateforme de Gestion des Absences et Congés du Personnel Universitaire.
            <br>Developed by
            <a target="_blank" class="fw-bold text-success" href="https://github.com/HasanMahmudDev">Étudiant Agrotic</a>
            &bull; Template par
            <a target="_blank" class="fw-bold text-success" href="https://themewagon.com">ThemeWagon</a>
          </span>
          <span>v1.0</span>
        </div>
      </footer>

    </div>
  </div>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
