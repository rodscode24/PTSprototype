@extends('layouts.admin')

@section('title', 'Team CMS')
@section('hide_topbar', true)

@section('content')
  <div class="cms-toolbar">
    <div>
      <p class="eyebrow">Team page CMS</p>
      <h1>Team Members</h1>
      <p>Add, edit, remove, reorder, and update team member photos and bios.</p>
    </div>
    <a class="banner-button" href="{{ route('team') }}" target="_blank" rel="noopener">View public team page</a>
  </div>

  @if (session('status'))
    <div class="admin-alert success">{{ session('status') }}</div>
  @endif

  @if ($errors->any())
    <div class="admin-alert error">{{ $errors->first() }}</div>
  @endif

  <section class="cms-editor-grid">
    <form class="panel cms-editor-form" action="{{ route('admin.team.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="panel-header">
        <div>
          <h2>Add new team member</h2>
          <p>Create a new card for the public Team page.</p>
        </div>
        <button class="btn btn-primary" type="submit">Add member</button>
      </div>

      <div class="editor-fields">
        <label>Name
          <input name="name" type="text" value="{{ old('name') }}" required>
        </label>

        <label>Credentials / Position
          <input name="credentials" type="text" value="{{ old('credentials') }}" placeholder="PT, DPT, Front Office Specialist">
        </label>

        <label>Profile image
          <input name="image" type="file" accept="image/*">
          <span class="field-help">Optional. If left blank, the card will show the member’s initial.</span>
        </label>

        <label>Display order
          <input name="sort_order" type="number" min="0" max="999" value="{{ old('sort_order', ($teamMembers->max('sort_order') ?? 0) + 1) }}" required>
        </label>

        <label class="checkbox-field">
          <input name="is_active" type="checkbox" value="1" checked>
          Show on public Team page
        </label>

        <label>Bio
          <textarea name="bio" rows="7" required>{{ old('bio') }}</textarea>
        </label>
      </div>
    </form>

    <aside class="panel" aria-labelledby="team-status-title">
      <div class="panel-header">
        <div>
          <h2 id="team-status-title">Team summary</h2>
          <p>Current public team setup.</p>
        </div>
      </div>
      <div class="side-panel-body">
        <div class="mini-card">
          <span>Total records</span>
          <strong>{{ $teamMembers->count() }}</strong>
        </div>
        <div class="mini-card">
          <span>Visible publicly</span>
          <strong>{{ $teamMembers->where('is_active', true)->count() }}</strong>
        </div>
        <div class="mini-card">
          <span>Public page</span>
          <strong>/team</strong>
        </div>
      </div>
    </aside>
  </section>

  <section class="panel submissions-panel" aria-labelledby="team-list-title">
    <div class="panel-header">
      <div>
        <h2 id="team-list-title">Edit existing team members</h2>
        <p>Each card below controls one person on the public Team page.</p>
      </div>
      <span class="status-badge">Live database</span>
    </div>

    <div class="team-admin-grid">
      @foreach ($teamMembers as $member)
        <article class="team-admin-card">
          <div class="team-admin-photo">
            @if ($member->imageUrl())
              <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}">
            @else
              <span>{{ \Illuminate\Support\Str::of($member->name)->substr(0, 1) }}</span>
            @endif
          </div>

          <form action="{{ route('admin.team.update', $member) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label>Name
              <input name="name" type="text" value="{{ old('name', $member->name) }}" required>
            </label>

            <label>Credentials / Position
              <input name="credentials" type="text" value="{{ old('credentials', $member->credentials) }}">
            </label>

            <label>Replace image
              <input name="image" type="file" accept="image/*">
            </label>

            <label>Display order
              <input name="sort_order" type="number" min="0" max="999" value="{{ old('sort_order', $member->sort_order) }}" required>
            </label>

            <label class="checkbox-field">
              <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $member->is_active))>
              Show on public Team page
            </label>

            <label>Bio
              <textarea name="bio" rows="8" required>{{ old('bio', $member->bio) }}</textarea>
            </label>

            <div class="team-admin-actions">
              <button class="btn btn-primary" type="submit">Save</button>
            </div>
          </form>

          <form class="delete-form" action="{{ route('admin.team.destroy', $member) }}" method="post" onsubmit="return confirm('Remove this team member?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline" type="submit">Remove</button>
          </form>
        </article>
      @endforeach
    </div>
  </section>
@endsection
