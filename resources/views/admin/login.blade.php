<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Developer Login | Physical Therapy Services</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logos/pts-nav-logo.png') }}">
  <link rel="shortcut icon" href="{{ asset('assets/images/logos/pts-nav-logo.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css?v=1.0.0">
  <style>
    body { min-height: 100vh; background: linear-gradient(135deg, var(--soft), var(--mint)); }
    .auth-shell { min-height: 100vh; display: grid; place-items: center; padding: 32px 16px; }
    .auth-card { width: min(100%, 460px); padding: 34px; }
    .auth-brand { margin-bottom: 24px; }
    .auth-card h1 { margin: 0 0 8px; color: var(--ink); font-family: var(--font-heading); font-size: 2rem; line-height: 1.1; }
    .auth-card p { color: var(--muted); }
    .field { display: grid; gap: 7px; margin-bottom: 16px; }
    .field label { color: var(--ink); font-weight: 900; }
    .field input { width: 100%; min-height: 48px; padding: 12px 14px; border: 1px solid var(--line); border-radius: var(--radius); background: #fff; color: var(--ink); }
    .auth-row { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-top: 8px; }
    .auth-link { color: var(--blue); font-weight: 900; }
    .form-error { margin-bottom: 16px; padding: 12px 14px; color: #8a1f12; background: #fff1ef; border: 1px solid #ffd3cc; border-radius: var(--radius); font-weight: 700; }
    @media (max-width: 560px) { .auth-card { padding: 24px; } .auth-row { align-items: stretch; flex-direction: column; } }
  </style>
</head>
<body>
  <main class="auth-shell">
    <section class="card auth-card" aria-labelledby="login-title">
      <a class="brand auth-brand" href="/">
        <span class="brand-mark">PTS</span>
        <span>Physical Therapy Services <small>Developer access</small></span>
      </a>
      <p class="eyebrow">Private area</p>
      <h1 id="login-title">Developer login</h1>
      <p>Sign in to manage the local admin dashboard.</p>

      @if ($errors->any())
        <div class="form-error">{{ $errors->first() }}</div>
      @endif

      <form method="POST" action="{{ route('devlogin.store') }}">
        @csrf
        <div class="field">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
        </div>
        <div class="field">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" autocomplete="current-password" required>
        </div>
        <div class="auth-row">
          <a class="auth-link" href="{{ route('devlogin.forgot') }}">Forgot password?</a>
          <button class="btn btn-primary" type="submit">Log in</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
