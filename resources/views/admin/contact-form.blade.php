@extends('layouts.admin')

@section('title', 'Contact Form CMS')
@section('hide_topbar', true)

@section('content')
  <div class="cms-toolbar">
    <div>
      <p class="eyebrow">Contact page CMS</p>
      <h1>Contact Form</h1>
      <p>Update the contact page banner, text, contact details, and form email destination.</p>
    </div>
    <a class="banner-button" href="{{ route('contact') }}" target="_blank" rel="noopener">View public page</a>
  </div>

  @if (session('status'))
    <div class="admin-alert success">{{ session('status') }}</div>
  @endif

  @if ($errors->any())
    <div class="admin-alert error">{{ $errors->first() }}</div>
  @endif

  <div class="embedded-public-page">
    <section class="page-hero contact-hero" style="--contact-hero-image: url('{{ $contactSettings->heroImageUrl() }}');">
      <div class="container reveal visible">
        <p class="eyebrow">{{ $contactSettings->hero_eyebrow }}</p>
        <h1>{{ $contactSettings->hero_title }}</h1>
        <p>{{ $contactSettings->hero_subtitle }}</p>
      </div>
    </section>

    <section class="section admin-contact-section">
      <div class="container contact-grid">
        <aside class="card card-pad reveal visible">
          <h2>{{ $contactSettings->contact_heading }}</h2>
          <p class="notice">{{ $contactSettings->notice }}</p>
          <div class="info-list">
            <p><strong>Phone</strong><br><a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactSettings->phone) }}">{{ $contactSettings->phone }}</a></p>
            <p><strong>Fax</strong><br>{{ $contactSettings->fax }}</p>
            <p><strong>Email</strong><br><a href="mailto:{{ $contactSettings->public_email }}">{{ $contactSettings->public_email }}</a></p>
            <p><strong>Address</strong><br>{!! nl2br(e($contactSettings->address)) !!}</p>
            <p><strong>Hours</strong><br>{!! nl2br(e($contactSettings->hours)) !!}</p>
          </div>
          <div class="badge-row">
            <span class="badge">CMS preview</span>
            <span class="badge">{{ number_format($totalInquiries) }} inquiries</span>
            <span class="badge">{{ $latestInquiry?->identifier ?? 'No GCI yet' }}</span>
          </div>
        </aside>

        <form class="card contact-form reveal visible" data-form action="{{ route('contact.submit') }}" method="post" novalidate>
          <h2>General contact form</h2>
          @csrf
          <label class="hp-field">Leave this field empty<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
          <label>First Name<input name="first_name" type="text" autocomplete="given-name" required></label>
          <label>Last Name<input name="last_name" type="text" autocomplete="family-name" required></label>
          <label>Email Address<input name="email" type="email" autocomplete="email" required></label>
          <label>Phone Number<input name="phone" type="tel" autocomplete="tel"></label>
          <label>Subject<input name="subject" type="text" required></label>
          <label>Message<textarea name="message" rows="5" required></textarea></label>
          <button class="btn btn-primary" type="submit">Send Message</button>
          <p class="form-status" role="status" aria-live="polite"></p>
        </form>
      </div>
    </section>
  </div>

  <section class="cms-editor-grid">
    <form class="panel cms-editor-form" action="{{ route('admin.contact.update') }}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="panel-header">
        <div>
          <h2>Edit contact page content</h2>
          <p>These fields control what appears on the public contact page.</p>
        </div>
        <button class="btn btn-primary" type="submit">Save changes</button>
      </div>

      <div class="editor-fields">
        <label>Banner eyebrow
          <input name="hero_eyebrow" type="text" value="{{ old('hero_eyebrow', $contactSettings->hero_eyebrow) }}" required>
        </label>

        <label>Banner title
          <input name="hero_title" type="text" value="{{ old('hero_title', $contactSettings->hero_title) }}" required>
        </label>

        <label>Banner subtitle
          <textarea name="hero_subtitle" rows="2" required>{{ old('hero_subtitle', $contactSettings->hero_subtitle) }}</textarea>
        </label>

        <label>Banner photo
          <input name="hero_image" type="file" accept="image/*">
          <span class="field-help">Upload a new image only if you want to replace the current banner photo.</span>
        </label>

        <label>Contact heading
          <input name="contact_heading" type="text" value="{{ old('contact_heading', $contactSettings->contact_heading) }}" required>
        </label>

        <label>Notice text
          <textarea name="notice" rows="5" required>{{ old('notice', $contactSettings->notice) }}</textarea>
        </label>

        <label>Phone
          <input name="phone" type="text" value="{{ old('phone', $contactSettings->phone) }}" required>
        </label>

        <label>Fax
          <input name="fax" type="text" value="{{ old('fax', $contactSettings->fax) }}">
        </label>

        <label>Public email shown on page
          <input name="public_email" type="email" value="{{ old('public_email', $contactSettings->public_email) }}" required>
        </label>

        <label>Address
          <textarea name="address" rows="4" required>{{ old('address', $contactSettings->address) }}</textarea>
        </label>

        <label>Hours
          <textarea name="hours" rows="5" required>{{ old('hours', $contactSettings->hours) }}</textarea>
        </label>
      </div>
    </form>

    <aside class="panel" aria-labelledby="cms-status-title">
      <div class="panel-header">
        <div>
          <h2 id="cms-status-title">Current settings</h2>
          <p>Quick reference for this page.</p>
        </div>
      </div>
      <div class="side-panel-body">
        <div class="mini-card">
          <span>Public page</span>
          <strong>/contact</strong>
        </div>
        <div class="mini-card">
          <span>Admin CMS page</span>
          <strong>/admin/contact-form</strong>
        </div>
        <div class="mini-card">
          <span>Current banner</span>
          <strong>{{ $contactSettings->hero_image_path }}</strong>
        </div>
      </div>
    </aside>
  </section>

  <section class="panel submissions-panel" aria-labelledby="submissions-title">
    <div class="panel-header">
      <div>
        <h2 id="submissions-title">Contact form submissions</h2>
        <p>Every message submitted through the general contact form.</p>
      </div>
      <span class="status-badge">Live database</span>
    </div>

    @if ($recentInquiries->isEmpty())
      <div class="empty-state">No contact form submissions yet.</div>
    @else
      <div class="table-wrap">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Reference</th>
              <th>Name</th>
              <th>Phone</th>
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
                <td>{{ $inquiry->phone ?: '—' }}</td>
                <td>
                  {{ $inquiry->subject }}
                  <span class="muted">{{ \Illuminate\Support\Str::limit($inquiry->message, 86) }}</span>
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

      <div class="pagination-wrap">
        {{ $recentInquiries->links() }}
      </div>
    @endif
  </section>
@endsection

@section('scripts')
  <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
