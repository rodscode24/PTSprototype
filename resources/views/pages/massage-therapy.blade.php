@extends('layouts.public')

@section('title', 'Massage Therapy | Physical Therapy Services Eugene')
@section('description', 'Massage therapy at Physical Therapy Services can help with injury, muscle tightness, and pain. View Eugene massage pricing and packages.')
@section('canonical', 'https://www.ptsclinic.com/massage-therapy')
@section('og_title', 'Massage Therapy at PTS')
@section('og_description', 'Self-pay massage visits and packages in Eugene, Oregon.')
@section('active', 'massage')

@section('content')
<section class="page-hero massage-hero"><div class="container reveal"><p class="eyebrow">Massage therapy</p><h1>Targeted massage for injury, muscle tightness, and overall pain.</h1><p>PTS includes manual therapy in treatment when appropriate and offers self-pay massage therapy options for current patients and the public.</p></div></section>

    <section class="section">
      <div class="container split">
        <div class="reveal">
          <p class="eyebrow">Service overview</p>
          <h2>Massage Therapy</h2>
          <p>Massage therapy can be very effective in helping with injury, muscle tightness, and overall pain. We at PTS include manual therapy in your treatment when we feel it is necessary.</p>
          <p>There is also a self pay massage therapy option for the public as well as current patients. Our massage therapist offers years of experience, and is dedicated to personalized care for each patient. If you are interested in booking a self pay massage see the below price list.</p>
        </div>
        <div class="card image-panel reveal"><div class="owned-visual massage-visual" role="img" aria-label="Abstract massage therapy room illustration"><span>Massage therapy</span></div></div>
      </div>
    </section>

    <section class="section soft">
      <div class="container">
        <div class="section-heading reveal"><p class="eyebrow">Pricing</p><h2>Single visits and package options.</h2><p>Prices are based on the current PTS massage price list.</p></div>
        <div class="grid grid-3">
          <article class="card card-pad price reveal"><h3>15 minute massage</h3><strong>$23</strong><p>Focused work for a specific area.</p></article>
          <article class="card card-pad price reveal"><h3>30 minute massage</h3><strong>$40</strong><p>Targeted care for one or two priority areas.</p></article>
          <article class="card card-pad price reveal"><h3>45 minute massage</h3><strong>$60</strong><p>Longer session for broader soft-tissue work.</p></article>
        </div>
        <div class="grid grid-3" style="margin-top:20px">
          <article class="card card-pad price reveal"><span class="tag">15 min packages</span><h3>4, 6, or 8 visits</h3><p><strong>$87.40</strong>4 visits</p><p>$126.96 for 6 visits<br>$165.60 for 8 visits</p></article>
          <article class="card card-pad price reveal"><span class="tag">30 min packages</span><h3>4, 6, or 8 visits</h3><p><strong>$152</strong>4 visits</p><p>$220.80 for 6 visits<br>$288.00 for 8 visits</p></article>
          <article class="card card-pad price reveal"><span class="tag">45 min packages</span><h3>4, 6, or 8 visits</h3><p><strong>$228</strong>4 visits</p><p>$331.20 for 6 visits<br>$432.00 for 8 visits</p></article>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container grid grid-3">
        <article class="card card-pad reveal"><span class="icon">01</span><h3>Conditions treated</h3><p>Muscle tightness, soreness, pain related to injury, stress-related tension, and mobility restrictions that benefit from soft-tissue care.</p></article>
        <article class="card card-pad reveal"><span class="icon">02</span><h3>Massage types</h3><p>Focused therapeutic massage, recovery-focused massage, integrated manual therapy support, and short area-specific sessions.</p></article>
        <article class="card card-pad reveal"><span class="icon">03</span><h3>Booking</h3><p>Call the clinic to check massage availability. Please do not send confidential medical information through email.</p></article>
      </div>
    </section>

    <section class="section soft">
      <div class="container split">
        <div class="reveal"><p class="eyebrow">FAQ</p><h2>Massage therapy questions.</h2></div>
        <div class="accordion reveal" data-accordion>
          <button type="button" aria-expanded="false">Can non-patients book massage?</button><div class="panel"><div><p>Yes. PTS offers self-pay massage therapy for the public as well as current patients.</p></div></div>
          <button type="button" aria-expanded="false">Is massage part of physical therapy?</button><div class="panel"><div><p>PTS may include manual therapy or soft-tissue work in your treatment when it is clinically appropriate.</p></div></div>
          <button type="button" aria-expanded="false">How do I choose a session length?</button><div class="panel"><div><p>Shorter sessions are helpful for focused areas. Longer sessions allow broader work. Call the clinic for guidance.</p></div></div>
        </div>
      </div>
    </section>
    <section class="cta-band"><div class="container cta-inner reveal"><div><h2>Book a massage therapy session.</h2><p>Call PTS to check availability.</p></div><a class="btn btn-coral" href="tel:+15413457532">Call PTS</a></div></section>
@endsection
