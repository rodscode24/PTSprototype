@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('page_title', 'Admin dashboard')
@section('page_subtitle', 'Manage and monitor the PTS website workspace.')

@section('content')
  <section class="welcome-banner" aria-labelledby="welcome-title">
    <div>
      <p class="eyebrow">Private workspace</p>
      <h2 id="welcome-title">Welcome back to the PTS admin area.</h2>
      <p>Contact submissions are saved to the local database and sent to the clinic email. Your public pages stay separate from this private dashboard.</p>
    </div>
    <a class="banner-button" href="{{ route('admin.contact') }}">Manage contact form</a>
  </section>

  <section class="summary-grid" aria-label="Dashboard summary">
    <article class="summary-card">
      <div class="summary-head">
        <h3>Total inquiries</h3>
        <span class="summary-icon">✉</span>
      </div>
      <strong>{{ number_format($totalInquiries) }}</strong>
      <span>General contact form records</span>
    </article>

    <article class="summary-card">
      <div class="summary-head">
        <h3>Latest reference</h3>
        <span class="summary-icon">#</span>
      </div>
      <strong>{{ $latestInquiry?->identifier ?? 'None' }}</strong>
      <span>{{ $latestInquiry ? $latestInquiry->created_at->diffForHumans() : 'No submissions yet' }}</span>
    </article>

    <article class="summary-card">
      <div class="summary-head">
        <h3>Email delivery</h3>
        <span class="summary-icon">✓</span>
      </div>
      <strong>Active</strong>
      <span>Receiving address is kept private</span>
    </article>

    <article class="summary-card">
      <div class="summary-head">
        <h3>Access</h3>
        <span class="summary-icon">🔒</span>
      </div>
      <strong>Private</strong>
      <span>Database login required</span>
    </article>
  </section>

  <section class="dashboard-grid">
    <article class="panel" aria-labelledby="submissions-title">
      <div class="panel-header">
        <div>
          <h2 id="submissions-title">Recent contact submissions</h2>
          <p>Latest messages from the general contact form.</p>
        </div>
        <span class="status-badge">Live database</span>
      </div>

      @if ($recentInquiries->isEmpty())
        <div class="empty-state">No contact form submissions yet. Once visitors send messages, they will appear here.</div>
      @else
        <div class="table-wrap">
          <table class="admin-table">
            <thead>
              <tr>
                <th>Reference</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Sent To</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($recentInquiries as $inquiry)
                <tr>
                  <td><span class="identifier">{{ $inquiry->identifier }}</span></td>
                  <td>
                    {{ $inquiry->full_name }}
                    <span class="muted">{{ $inquiry->email }}</span>
                  </td>
                  <td>
                    {{ $inquiry->subject }}
                    <span class="muted">{{ \Illuminate\Support\Str::limit($inquiry->message, 68) }}</span>
                  </td>
                  <td>{{ $inquiry->sent_to }}</td>
                  <td>
                    {{ $inquiry->created_at->format('M j, Y') }}
                    <span class="muted">{{ $inquiry->created_at->format('g:i A') }}</span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </article>

    <aside class="panel" aria-labelledby="quick-info-title">
      <div class="panel-header">
        <div>
          <h2 id="quick-info-title">Quick info</h2>
          <p>Current admin setup.</p>
        </div>
      </div>
      <div class="side-panel-body">
        <div class="mini-card">
          <span>Logged in as</span>
          <strong>{{ $adminEmail }}</strong>
        </div>
        <div class="mini-card">
          <span>Contact email</span>
          <strong>Private mail setting enabled</strong>
        </div>
        <div class="mini-card">
          <span>Latest message</span>
          @if ($latestInquiry)
            <strong>{{ $latestInquiry->subject }}</strong>
            <p class="message-preview">{{ \Illuminate\Support\Str::limit($latestInquiry->message, 120) }}</p>
          @else
            <strong>No message yet</strong>
          @endif
        </div>
        <div class="mini-card">
          <span>Security</span>
          <strong>Admin password is stored as a database hash.</strong>
        </div>
      </div>
    </aside>
  </section>
@endsection
