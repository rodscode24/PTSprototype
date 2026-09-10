@extends('layouts.public')

@section('title', 'Contact, Address, and Hours | Physical Therapy Services Eugene')
@section('description', 'Contact Physical Therapy Services in Eugene, Oregon. Call (541) 345-7532, view clinic hours, send a general inquiry, and get directions to 1310 Coburg Rd #5.')
@section('canonical', 'https://www.ptsclinic.com/contact-address-hours')
@section('og_title', 'Contact Physical Therapy Services')
@section('og_description', 'Phone, email, hours, address, directions, and general contact form for PTS in Eugene.')
@section('active', 'contact')

@section('content')
<section class="page-hero contact-hero" style="--contact-hero-image: url('{{ $contactSettings->heroImageUrl() }}');"><div class="container reveal"><p class="eyebrow">{{ $contactSettings->hero_eyebrow }}</p><h1>{{ $contactSettings->hero_title }}</h1><p>{{ $contactSettings->hero_subtitle }}</p></div></section>

    <section class="section">
      <div class="container contact-grid">
        <aside class="card card-pad reveal">
          <h2>{{ $contactSettings->contact_heading }}</h2>
          <p class="notice">{{ $contactSettings->notice }}</p>
          <div class="info-list">
            <p><strong>Phone</strong><br><a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactSettings->phone) }}">{{ $contactSettings->phone }}</a></p>
            <p><strong>Fax</strong><br>{{ $contactSettings->fax }}</p>
            <p><strong>Email</strong><br><a href="mailto:{{ $contactSettings->public_email }}">{{ $contactSettings->public_email }}</a></p>
            <p><strong>Address</strong><br>{!! nl2br(e($contactSettings->address)) !!}</p>
            <p><strong>Hours</strong><br>{!! nl2br(e($contactSettings->hours)) !!}</p>
          </div>
          <div class="badge-row"><a class="badge" href="tel:{{ preg_replace('/[^0-9+]/', '', $contactSettings->phone) }}">Click to call</a><a class="badge" href="https://www.facebook.com/ptsclinic" rel="noopener">Facebook</a><a class="badge" href="https://www.google.com/maps?q=1310+Coburg+Rd+%235+Eugene+OR+97401" rel="noopener">Google Maps</a></div>
        </aside>

        <form class="card contact-form reveal" data-form action="{{ route('contact.submit') }}" method="post" novalidate>
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

    <section class="section soft" id="directions">
      <div class="container">
        <div class="map reveal"><iframe title="Map to Physical Therapy Services in Eugene" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=1310%20Coburg%20Rd%20%235%2C%20Eugene%2C%20OR%2097401&output=embed"></iframe></div>
        <div class="card card-pad reveal" style="margin-top:20px"><h2>Driving directions</h2><p>PTS is located at 1310 Coburg Rd #5 in Eugene. Use the Google Maps link above for turn-by-turn directions and parking details before your visit.</p><a class="btn btn-outline" href="https://www.google.com/maps/dir/?api=1&destination=1310+Coburg+Rd+%235,+Eugene,+OR+97401" rel="noopener">Open Directions</a></div>
      </div>
    </section>
@endsection
