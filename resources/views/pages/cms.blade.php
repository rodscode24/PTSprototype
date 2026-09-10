@extends('layouts.public')

@section('title', $page->slug === 'home' ? 'Physical Therapy Services | Eugene Physical Therapy Clinic' : $page->name.' | Physical Therapy Services Eugene')
@section('description', $page->hero_subtitle)
@section('og_title', $page->slug === 'home' ? 'Physical Therapy Services | Eugene Physical Therapy Clinic' : $page->name.' | Physical Therapy Services')
@section('og_description', $page->hero_subtitle)
@section('active', $page->slug === 'massage' ? 'massage' : $page->public_route)

@if ($page->slug === 'home')
@section('canonical', 'https://www.ptsclinic.com/')
@section('head')
<meta property="og:url" content="https://www.ptsclinic.com/">
<meta property="og:image" content="/assets/images/logos/pts-hero-logo.png">
<script type="application/ld+json">
  {
    "@@context": "https://schema.org",
    "@@type": "MedicalClinic",
    "name": "Physical Therapy Services",
    "url": "https://www.ptsclinic.com/",
    "telephone": "+1-541-345-7532",
    "faxNumber": "+1-541-345-6692",
    "email": "info@ptsclinic.com",
    "medicalSpecialty": ["PhysicalTherapy", "MassageTherapy", "Rehabilitation"],
    "address": {
      "@@type": "PostalAddress",
      "streetAddress": "1310 Coburg Rd #5",
      "addressLocality": "Eugene",
      "addressRegion": "OR",
      "postalCode": "97401",
      "addressCountry": "US"
    },
    "openingHoursSpecification": [{
      "@@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
      "opens": "08:00",
      "closes": "18:00"
    }]
  }
  </script>
@endsection
@endif

@section('content')
  @if ($page->slug === 'home')
    <section class="hero" style="--cms-hero-image: url('{{ $page->heroImageUrl() }}');">
      <div class="container">
        <div class="reveal">
          <img class="hero-logo" src="{{ asset('assets/images/logos/pts-hero-logo.png') }}" alt="Physical Therapy Services">
          <h1 class="sr-only">{{ $page->hero_title }}</h1>
          <p>{{ $page->hero_subtitle }}</p>
          <div class="hero-actions">
            <a class="btn btn-primary" href="{{ route('contact') }}">Contact Us</a>
            <a class="btn btn-light" href="tel:+15413457532">Call (541) 345-7532</a>
          </div>
          <div class="trust-list" aria-label="Clinic highlights">
            <span>Evidence-based treatment</span>
            <span>Manual therapy</span>
            <span>STOTT Pilates</span>
            <span>Graston Technique</span>
          </div>
        </div>
      </div>
    </section>
  @else
    <section class="page-hero" style="--cms-hero-image: url('{{ $page->heroImageUrl() }}');">
      <div class="container reveal">
        <p class="eyebrow">{{ $page->hero_eyebrow }}</p>
        <h1>{{ $page->hero_title }}</h1>
        <p>{{ $page->hero_subtitle }}</p>
      </div>
    </section>
  @endif

  {!! $page->visibleBodyHtml() !!}
@endsection
