<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard') | Physical Therapy Services</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logos/pts-nav-logo.png') }}">
  <link rel="shortcut icon" href="{{ asset('assets/images/logos/pts-nav-logo.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
  @yield('head')
</head>
<body>
  <div class="dashboard-shell">
    <aside class="sidebar" aria-label="Admin navigation">
      <a class="admin-brand" href="{{ route('admin.dashboard') }}">
        <span class="brand-mark">PTS</span>
        <span>
          <strong>Physical Therapy Services</strong>
          <small>Admin workspace</small>
        </span>
      </a>

      <div class="admin-profile">
        <div class="profile-avatar">✓</div>
        <strong>PTS Developer</strong>
        <span>{{ $adminEmail ?? auth()->user()?->email }}</span>
      </div>

      <nav class="sidebar-nav">
        @php
          $cmsIsOpen = request()->routeIs('admin.contact') || request()->routeIs('admin.cms.edit');
        @endphp

        <a class="sidebar-link {{ request()->routeIs('admin.dashboard', 'admin.dashboard.alias') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><span class="icon">▦</span> Dashboard</a>

        <div class="sidebar-group {{ $cmsIsOpen ? 'open' : '' }}" data-sidebar-group>
          <button class="sidebar-link sidebar-group-toggle {{ $cmsIsOpen ? 'active' : '' }}" type="button" aria-expanded="{{ $cmsIsOpen ? 'true' : 'false' }}" data-sidebar-toggle>
            <span class="icon" data-sidebar-symbol>{{ $cmsIsOpen ? '−' : '+' }}</span>
            <span>CMS</span>
          </button>
          <ul class="sidebar-subnav" data-sidebar-subnav>
            <li><a class="sidebar-sub-link {{ request()->routeIs('admin.contact') ? 'active' : '' }}" href="{{ route('admin.contact') }}"><span class="sub-dot">✉</span> Contact Form</a></li>
            <li><a class="sidebar-sub-link {{ request()->routeIs('admin.cms.edit') && request()->route('slug') === 'home' ? 'active' : '' }}" href="{{ route('admin.cms.edit', 'home') }}"><span class="sub-dot">⌂</span> Home</a></li>
            <li><a class="sidebar-sub-link {{ request()->routeIs('admin.cms.edit') && request()->route('slug') === 'about' ? 'active' : '' }}" href="{{ route('admin.cms.edit', 'about') }}"><span class="sub-dot">ⓘ</span> About</a></li>
            <li><a class="sidebar-sub-link {{ request()->routeIs('admin.cms.edit') && request()->route('slug') === 'services' ? 'active' : '' }}" href="{{ route('admin.cms.edit', 'services') }}"><span class="sub-dot">＋</span> Services</a></li>
            <li><a class="sidebar-sub-link {{ request()->routeIs('admin.cms.edit') && request()->route('slug') === 'massage' ? 'active' : '' }}" href="{{ route('admin.cms.edit', 'massage') }}"><span class="sub-dot">◌</span> Massage</a></li>
            <li><a class="sidebar-sub-link {{ request()->routeIs('admin.cms.edit') && request()->route('slug') === 'new-patients' ? 'active' : '' }}" href="{{ route('admin.cms.edit', 'new-patients') }}"><span class="sub-dot">✚</span> New Patients</a></li>
          </ul>
        </div>

        <a class="sidebar-link {{ request()->routeIs('admin.team') ? 'active' : '' }}" href="{{ route('admin.team') }}"><span class="icon">☻</span> Team</a>
        <a class="sidebar-link {{ request()->routeIs('admin.audit') ? 'active' : '' }}" href="{{ route('admin.audit') }}"><span class="icon">↕</span> Audit Log</a>
        <a class="sidebar-link" href="{{ route('home') }}"><span class="icon">⌂</span> View Site</a>
      </nav>

      <div class="sidebar-spacer"></div>

      <form class="logout-card" method="POST" action="{{ route('devlogout') }}">
        @csrf
        <button class="btn btn-primary" type="submit">Log out</button>
      </form>
    </aside>

    <main class="dashboard-content">
      @hasSection('hide_topbar')
      @else
        <header class="topbar">
          <div>
            <h1>@yield('page_title', 'Admin dashboard')</h1>
            <p>@yield('page_subtitle', 'Manage and monitor the PTS website workspace.')</p>
          </div>
          <div class="topbar-actions" aria-label="Quick actions">
            <span class="round-action">⌕</span>
            <span class="round-action">✉</span>
            <span class="round-action">☾</span>
          </div>
        </header>
      @endif

      @yield('content')
    </main>
  </div>
  <script>
    document.querySelectorAll('[data-sidebar-toggle]').forEach((toggle) => {
      toggle.addEventListener('click', () => {
        const group = toggle.closest('[data-sidebar-group]');
        const symbol = toggle.querySelector('[data-sidebar-symbol]');
        const isOpen = group.classList.toggle('open');

        toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        if (symbol) {
          symbol.textContent = isOpen ? '−' : '+';
        }
      });
    });
  </script>
  @yield('scripts')
</body>
</html>
