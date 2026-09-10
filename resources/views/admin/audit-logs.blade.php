@extends('layouts.admin')

@section('title', 'Audit Log')
@section('page_title', 'Audit Log')
@section('page_subtitle', 'Review admin changes by category, page, person, and time.')

@section('content')
  <section class="panel">
    <div class="panel-header">
      <div>
        <h2>Admin change history</h2>
        <p>Everything changed through the admin CMS is recorded here.</p>
      </div>
      <span class="status-badge">Live database</span>
    </div>

    <div class="audit-filter">
      <a class="filter-pill {{ $selectedCategory ? '' : 'active' }}" href="{{ route('admin.audit') }}">All</a>
      @foreach ($categories as $category)
        <a class="filter-pill {{ $selectedCategory === $category ? 'active' : '' }}" href="{{ route('admin.audit', ['category' => $category]) }}">{{ $category }}</a>
      @endforeach
    </div>

    @if ($logs->isEmpty())
      <div class="empty-state">No audit log records yet. Changes will appear here after you update CMS content.</div>
    @else
      <div class="audit-list">
        @foreach ($logs as $log)
          <article class="audit-card">
            <div class="audit-card-main">
              <span class="audit-category">{{ $log->category }}</span>
              <h3>{{ $log->action }}</h3>
              <p>{{ $log->subject_name ?? 'Admin record' }}</p>
              <span class="muted">By {{ $log->user_email ?? 'Unknown admin' }} • {{ $log->created_at->format('M j, Y g:i A') }}</span>
            </div>

            <div class="audit-changes">
              @forelse (($log->changes ?? []) as $field => $change)
                <div class="audit-change-row">
                  <strong>{{ \Illuminate\Support\Str::headline($field) }}</strong>
                  <span><b>Before:</b> {{ \Illuminate\Support\Str::limit((string) ($change['before'] ?? 'Blank'), 120) }}</span>
                  <span><b>After:</b> {{ \Illuminate\Support\Str::limit((string) ($change['after'] ?? 'Blank'), 120) }}</span>
                </div>
              @empty
                <div class="audit-change-row">
                  <strong>No field-level changes recorded</strong>
                  <span>This usually means a record was removed or created with default values.</span>
                </div>
              @endforelse
            </div>
          </article>
        @endforeach
      </div>

      <div class="pagination-wrap">
        {{ $logs->links() }}
      </div>
    @endif
  </section>
@endsection
