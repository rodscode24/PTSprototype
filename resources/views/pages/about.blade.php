@extends('layouts.public')

@section('title', 'About Physical Therapy Services | Eugene, Oregon')
@section('description', 'Learn about Physical Therapy Services, a family-oriented Eugene therapy clinic serving patients with hands-on, evidence-based care since 1978.')
@section('canonical', 'https://www.ptsclinic.com/about')
@section('og_title', 'About Physical Therapy Services')
@section('og_description', 'Professional, caring, evidence-based physical therapy in Eugene since 1978.')
@section('active', 'about')

@section('content')
<section class="page-hero about-hero"><div class="container reveal"><p class="eyebrow">About PTS</p><h1>Professional care with a welcoming, family-oriented approach.</h1><p>Physical Therapy Services has helped the Eugene area regain health, wellness, movement, and comfort since 1978.</p></div></section>

    <section class="section">
      <div class="container split">
        <div class="reveal">
          <p class="eyebrow">Clinic history</p>
          <h2>Decades of hands-on rehabilitation in Eugene.</h2>
          <p>The clinic's goal is to facilitate healing and restore efficient movement and comfort as quickly as possible. The team uses proven hands-on techniques, one-on-one therapy, individualized rehabilitation programs, and custom treatment plans designed for each patient.</p>
          <p>PTS has developed a local reputation as a trusted place to go for treatment and rehabilitation after an injury, with care guided by scientifically validated, evidence-based treatment.</p>
        </div>
        <div class="card card-pad reveal">
          <h3>Mission</h3><p>Help patients reduce pain, restore movement, and return to daily life with confidence.</p>
          <h3>Vision</h3><p>Be Eugene's trusted physical therapy clinic for personal, effective, and evidence-based rehabilitation.</p>
        </div>
      </div>
    </section>

    <section class="section soft">
      <div class="container">
        <div class="section-heading reveal"><p class="eyebrow">Values</p><h2>The standards behind every visit.</h2></div>
        <div class="grid grid-4">
          <article class="card card-pad reveal"><span class="icon">01</span><h3>Clinical excellence</h3><p>Treatment decisions are grounded in evidence, continuing education, and measured progress.</p></article>
          <article class="card card-pad reveal"><span class="icon">02</span><h3>Personal attention</h3><p>Patients receive plans matched to their condition, goals, schedule, and comfort level.</p></article>
          <article class="card card-pad reveal"><span class="icon">03</span><h3>Family-oriented care</h3><p>The clinic culture is welcoming, respectful, and supportive from intake through discharge.</p></article>
          <article class="card card-pad reveal"><span class="icon">04</span><h3>Community trust</h3><p>PTS serves Eugene with a long-term commitment to patient education and local wellness.</p></article>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container grid grid-3">
        <article class="card card-pad reveal"><h3>Professional certifications</h3><p>The team includes clinicians with advanced credentials in orthopedic manual therapy, STOTT Pilates instruction, lymphedema therapy, and massage therapy.</p></article>
        <article class="card card-pad reveal"><h3>Community involvement</h3><p>PTS supports Eugene and Springfield patients, families, physicians, and care teams with practical communication and recovery planning.</p></article>
        <article class="card card-pad reveal"><h3>Facility experience</h3><p>The clinic is designed for individual evaluations, guided exercise, hands-on treatment, and friendly front-office support.</p></article>
      </div>
    </section>

    <section class="section mint">
      <div class="container">
        <div class="section-heading reveal"><p class="eyebrow">Facility gallery</p><h2>A calm clinical setting for focused therapy.</h2></div>
        <div class="grid grid-3">
          <div class="card image-panel reveal"><div class="owned-visual gallery-visual gallery-room" role="img" aria-label="Abstract clinic treatment room illustration"><span>Treatment rooms</span></div></div>
          <div class="card image-panel reveal"><div class="owned-visual gallery-visual gallery-rehab" role="img" aria-label="Abstract rehabilitation exercise space illustration"><span>Rehab space</span></div></div>
          <div class="card image-panel reveal"><div class="owned-visual gallery-visual gallery-care" role="img" aria-label="Abstract consultation area illustration"><span>Patient care</span></div></div>
        </div>
      </div>
    </section>

    <section class="cta-band"><div class="container cta-inner reveal"><div><h2>Meet the people behind the care.</h2><p>Learn about the clinicians and support team who welcome patients at PTS.</p></div><a class="btn btn-coral" href="team.html">Meet the Team</a></div></section>
@endsection
