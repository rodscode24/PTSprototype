<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Physical Therapy Services')</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logos/pts-nav-logo.png') }}">
  <link rel="shortcut icon" href="{{ asset('assets/images/logos/pts-nav-logo.png') }}">
  <meta name="description" content="@yield('description', 'Physical Therapy Services in Eugene, Oregon provides evidence-based physical therapy, massage therapy, and rehabilitation care.')">
  @hasSection('canonical')
    <link rel="canonical" href="@yield('canonical')">
  @endif
  @hasSection('og_title')
    <meta property="og:title" content="@yield('og_title')">
  @endif
  @hasSection('og_description')
    <meta property="og:description" content="@yield('og_description')">
  @endif
  <meta property="og:type" content="website">
  <meta name="twitter:card" content="summary_large_image">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <script defer src="{{ asset('assets/js/main.js') }}"></script>
  @yield('head')
</head>
<body>
  <a class="skip-link" href="#main">Skip to content</a>
  <header class="site-header" data-header>
    <nav class="nav container" aria-label="Primary navigation">
      <a class="brand" href="{{ route('home') }}" aria-label="Physical Therapy Services home">
        <img class="nav-logo" src="{{ asset('assets/images/logos/pts-nav-logo.png') }}" alt="Physical Therapy Services">
        <span>Physical Therapy Services<small>Eugene, Oregon</small></span>
      </a>
      <button class="menu-toggle" type="button" aria-label="Open menu" aria-controls="primary-menu" aria-expanded="false"><span></span><span></span><span></span></button>
      <div class="nav-panel" id="primary-menu">
        <a href="{{ route('home') }}" @if(trim($__env->yieldContent('active')) === 'home') aria-current="page" @endif>Home</a>
        <a href="{{ route('about') }}" @if(trim($__env->yieldContent('active')) === 'about') aria-current="page" @endif>About</a>
        <a href="{{ route('services') }}" @if(trim($__env->yieldContent('active')) === 'services') aria-current="page" @endif>Services</a>
        <a href="{{ route('massage-therapy') }}" @if(trim($__env->yieldContent('active')) === 'massage') aria-current="page" @endif>Massage</a>
        <a href="{{ route('team') }}" @if(trim($__env->yieldContent('active')) === 'team') aria-current="page" @endif>Team</a>
        <a href="{{ route('new-patients') }}" @if(trim($__env->yieldContent('active')) === 'new-patients') aria-current="page" @endif>New Patients</a>
        <a href="{{ route('contact') }}" @if(trim($__env->yieldContent('active')) === 'contact') aria-current="page" @endif>Contact</a>
      </div>
    </nav>
  </header>

  <main id="main">
    @yield('content')
  </main>

  <footer class="site-footer">
    <div class="container footer-grid">
      <div><div class="footer-brand-text"><strong>Physical Therapy Services</strong><small>Eugene, Oregon</small></div><p>Evidence-based physical therapy, massage therapy, and rehabilitation care in Eugene.</p></div>
      <div><h3>Quick Links</h3><a href="{{ route('about') }}">About</a><a href="{{ route('services') }}">Services</a><a href="{{ route('team') }}">Our Team</a><a href="{{ route('new-patients') }}">New Patients</a></div>
      <div><h3>Services</h3><a href="{{ route('services') }}#physical-therapy">Physical Therapy</a><a href="{{ route('massage-therapy') }}">Massage Therapy</a><a href="{{ route('services') }}#lymphedema-therapy">Lymphedema Therapy</a><a href="{{ route('services') }}#sports-rehabilitation">Sports Rehab</a></div>
      <div><h3>Contact</h3><p>1310 Coburg Rd #5<br>Eugene, OR 97401</p><p><a href="tel:+15413457532">(541) 345-7532</a><br><a href="mailto:info@ptsclinic.com">info@ptsclinic.com</a></p></div>
    </div>
    <div class="container footer-bottom"><p>&copy; 2026 Physical Therapy Services. All rights reserved.</p><p>General inquiries only by email.</p></div>
  </footer>
  <a class="floating-btn call" href="tel:+15413457532" aria-label="Call Physical Therapy Services">Call</a>
  <button class="back-top" type="button" aria-label="Back to top">Top</button>
</body>
</html>
