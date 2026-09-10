@extends('layouts.public')

@section('title', 'Our Team | Physical Therapy Services Eugene')
@section('description', 'Meet the Physical Therapy Services team: physical therapists, PT assistants, massage therapists, and front-office specialists serving Eugene patients.')
@section('canonical', 'https://www.ptsclinic.com/our-team')
@section('og_title', 'Our Team | Physical Therapy Services')
@section('og_description', 'Passionate. Experienced. Professional. Family oriented.')
@section('active', 'team')

@section('content')
<section class="page-hero team-hero"><div class="container reveal"><p class="eyebrow">Our Team</p><h1>Passionate. Experienced. Professional. Family Oriented.</h1><p>Meet the clinical and support staff who help patients feel welcome, informed, and cared for at PTS.</p></div></section>
    <section class="section">
      <div class="container">
        <div class="grid grid-3">
          @foreach ($teamMembers as $member)
            <article class="card team-card reveal">
              @if ($member->imageUrl())
                <img class="team-photo-img" src="{{ $member->imageUrl() }}" alt="{{ $member->name }}" loading="lazy">
              @else
                <div class="team-photo-placeholder"><span>{{ \Illuminate\Support\Str::of($member->name)->substr(0, 1) }}</span></div>
              @endif
              <div class="card-pad">
                <h2>{{ $member->name }}</h2>
                @if ($member->credentials)
                  <p class="credentials">{{ $member->credentials }}</p>
                @endif
                @foreach (preg_split("/\r\n|\n|\r/", $member->bio) as $paragraph)
                  @if (trim($paragraph) !== '')
                    <p>{{ $paragraph }}</p>
                  @endif
                @endforeach
              </div>
            </article>
          @endforeach
        </div>
      </div>
    </section>
    <section class="cta-band"><div class="container cta-inner reveal"><div><h2>Ready to work with the PTS team?</h2><p>Call the clinic to start the scheduling process.</p></div><a class="btn btn-coral" href="tel:+15413457532">Call PTS</a></div></section>
@endsection
