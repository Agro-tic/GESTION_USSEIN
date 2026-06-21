<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="UniGestion authentication page">
  <title>Connexion | UniGestion</title>

  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="auth-body">
  <button class="icon-button theme-toggle auth-theme-toggle" type="button" data-theme-toggle aria-label="Switch color theme" title="Switch color theme">
    <i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
  </button>
  <main class="auth-page">
    <section class="auth-card">
      <a class="auth-brand" href="{{ route('dashboard') }}">
        <span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span>
        <span><strong>UniGestion</strong><small>Connectez-vous à votre espace.</small></span>
      </a>
      <div class="auth-visual"><img src="{{ asset('assets/images/png/dasher-ui-bootstrap-5.jpg') }}" alt="UniGestion dashboard"></div>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-4">
          <p class="eyebrow mb-1">Accès Sécurisé</p>
          <h1 class="h3 mb-1">Connexion</h1>
          <p class="text-muted mb-0">Connectez-vous à votre espace administrateur.</p>
        </div>

        <div class="mb-3">
          <label class="form-label" for="loginEmail">Adresse email</label>
          <input class="form-control @error('email') is-invalid @enderror"
                 id="loginEmail" name="email" type="email"
                 value="{{ old('email') }}" required>
          @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <div class="d-flex justify-content-between">
            <label class="form-label" for="loginPassword">Mot de passe</label>
          </div>
          <input class="form-control @error('password') is-invalid @enderror"
                 id="loginPassword" name="password" type="password" minlength="6" required>
          @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-check mb-4">
          <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
          <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
        </div>

        <button class="btn btn-primary w-100" type="submit">
          <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i> Se connecter
        </button>
      </form>

      <div class="auth-footer">Pas encore de compte ? <a href="{{ route('register') }}">Créer un compte</a></div>
    </section>
  </main>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>