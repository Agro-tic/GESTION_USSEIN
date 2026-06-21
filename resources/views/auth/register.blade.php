<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="UniGestion authentication page">
  <title>Register | UniGestion</title>

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
      <a class="auth-brand" href="{{ route('dashboard') }}"><span class="brand-icon"><i class="bi bi-grid-1x2-fill" aria-hidden="true"></i></span><span><strong>UniGestion</strong><small>Create your UniGestion account.</small></span></a>
      <div class="auth-visual"><img src="{{ asset('assets/images/png/dasher-ui-bootstrap-5.jpg') }}" alt="UniGestion dashboard interface"></div>

      @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form class="needs-validation" method="POST" action="{{ route('register.post') }}" novalidate>
        @csrf
        <div class="mb-4">
          <p class="eyebrow mb-1">Secure Access</p>
          <h1 class="h3 mb-1">Register</h1>
          <p class="text-muted mb-0">Create your UniGestion account.</p>
        </div>
        <div class="mb-3"><label class="form-label" for="registerName">Full name</label><input class="form-control" id="registerName" name="name" type="text" value="{{ old('name') }}" required><div class="invalid-feedback">Full name is required.</div></div>
        <div class="mb-3"><label class="form-label" for="registerEmail">Email address</label><input class="form-control" id="registerEmail" name="email" type="email" value="{{ old('email') }}" required><div class="invalid-feedback">Enter a valid email.</div></div>
        <div class="mb-3"><label class="form-label" for="registerPassword">Password</label><input class="form-control" id="registerPassword" name="password" type="password" minlength="6" required><div class="invalid-feedback">Password must be at least 6 characters.</div></div>
        <div class="mb-3"><label class="form-label" for="registerPasswordConfirm">Confirm Password</label><input class="form-control" id="registerPasswordConfirm" name="password_confirmation" type="password" minlength="6" required><div class="invalid-feedback">Passwords must match.</div></div>
        <div class="form-check mb-4"><input class="form-check-input" type="checkbox" id="terms" required><label class="form-check-label" for="terms">I agree to the terms</label><div class="invalid-feedback">You must agree before continuing.</div></div>
        <button class="btn btn-primary w-100" type="submit"><i class="bi bi-person-plus" aria-hidden="true"></i> Create Account</button>
      </form>

      <div class="auth-footer">Already have an account? <a href="{{ route('login') }}">Sign in</a></div>
    </section>
  </main>

  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
