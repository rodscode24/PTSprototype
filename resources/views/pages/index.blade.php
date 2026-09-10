@extends('layouts.public')

@section('title', 'Physical Therapy Services | Eugene Physical Therapy Clinic')
@section('description', 'Physical Therapy Services in Eugene, Oregon provides evidence-based physical therapy, massage therapy, manual therapy, STOTT Pilates, Graston Technique, lymphedema care, and rehabilitation.')
@section('canonical', 'https://www.ptsclinic.com/')
@section('og_title', 'Physical Therapy Services | Eugene Physical Therapy Clinic')
@section('og_description', 'Hands-on, one-on-one therapy and individualized rehabilitation in Eugene since 1978.')
@section('active', 'home')

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

@section('content')
<section class="hero">
      <div class="container">
        <div class="reveal">
          <img class="hero-logo" src="assets/images/logos/pts-hero-logo.png" alt="Physical Therapy Services">
          <p>Our goal at Physical Therapy Services is to facilitate healing and restore efficient movement and comfort as quickly as possible. We achieve this through proven hands-on techniques, one-on-one therapy, individualized rehabilitation programs and custom treatment plans designed individually for each patient.</p>
          <div class="hero-actions">
            <a class="btn btn-primary" href="contact.html">Contact Us</a>
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

    <section class="section">
      <div class="container split">
        <div class="reveal">
          <p class="eyebrow">About PTS</p>
          <h2>Helping patients in the Eugene area regain health and wellness since 1978.</h2>
          <p>Our team of qualified and experienced professionals has been helping patients in the Eugene area regain their health and wellness since 1978 and have developed a reputation as the place to go for treatment and rehabilitation after an injury.</p>
          <p>We use scientifically validated, evidence-based treatments to solve our patients' health problems. Contact us today to learn how our exceptional Physical Therapy Clinic can help make you feel like yourself once more.</p>
          <div class="badge-row">
            <span class="badge">Serving Eugene since 1978</span>
            <span class="badge">One-on-one therapy</span>
            <span class="badge">Personalized plans</span>
          </div>
        </div>
        <div class="card image-panel reveal">
          <div class="owned-visual care-visual" role="img" aria-label="Abstract therapy care illustration"><span>PTS</span></div>
        </div>
      </div>
    </section>

    <section class="section soft">
      <div class="container">
        <div class="section-heading reveal">
          <p class="eyebrow">Services</p>
          <h2>Scientifically validated, evidence-based treatments.</h2>
        </div>
        <div class="grid grid-3">
          <article class="card card-pad service-card reveal"><span class="icon">PT</span><h3>Physical Therapy</h3><p>Assessment-led care to restore movement and function after injury, illness, surgery, or pain.</p><a href="services.html#physical-therapy">Learn more</a></article>
          <article class="card card-pad service-card reveal"><span class="icon">MT</span><h3>Massage Therapy</h3><p>Self-pay and integrated massage options for pain, injury, muscle tightness, and overall discomfort.</p><a href="massage-therapy.html">Learn more</a></article>
          <article class="card card-pad service-card reveal"><span class="icon">MA</span><h3>Manual Therapy</h3><p>Hands-on joint and soft-tissue techniques paired with active rehabilitation.</p><a href="services.html#manual-therapy">Learn more</a></article>
          <article class="card card-pad service-card reveal"><span class="icon">SP</span><h3>STOTT Pilates</h3><p>Rehabilitation-focused movement training for core control, posture, and resilient motion.</p><a href="services.html#stott-pilates">Learn more</a></article>
          <article class="card card-pad service-card reveal"><span class="icon">GT</span><h3>Graston Technique</h3><p>Instrument-assisted soft tissue care that can help address restrictions and mobility limits.</p><a href="services.html#graston-technique">Learn more</a></article>
          <article class="card card-pad service-card reveal"><span class="icon">CL</span><h3>Lymphedema and Oncology Rehab</h3><p>Specialized support for swelling, oncology-related impairments, and recovery after treatment.</p><a href="services.html#lymphedema-therapy">Learn more</a></article>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="section-heading reveal">
          <p class="eyebrow">Why patients choose PTS</p>
          <h2>Care that is practical, personal, and grounded in clinical skill.</h2>
        </div>
        <div class="grid grid-4">
          <article class="card card-pad reveal"><span class="icon coral">1</span><h3>Hands-on treatment</h3><p>Manual techniques and guided movement help reduce barriers to recovery.</p></article>
          <article class="card card-pad reveal"><span class="icon coral">2</span><h3>Clear care plans</h3><p>Patients understand what is happening, why it matters, and how to keep progressing.</p></article>
          <article class="card card-pad reveal"><span class="icon coral">3</span><h3>Experienced team</h3><p>Licensed clinicians bring orthopedic, oncology, lymphedema, sports, and massage expertise.</p></article>
          <article class="card card-pad reveal"><span class="icon coral">4</span><h3>Welcoming support</h3><p>Front-office and clinical staff help make scheduling, reminders, and next steps easier.</p></article>
        </div>
      </div>
    </section>

    <section class="section stats">
      <div class="container stats-grid">
        <div><strong data-counter="48" data-suffix="+">0</strong><span>Years serving Eugene</span></div>
        <div><strong data-counter="10" data-suffix="+">0</strong><span>Core therapy services</span></div>
        <div><strong data-counter="1">0</strong><span>Individualized patient plan</span></div>
        <div><strong data-counter="1978">0</strong><span>Clinic history since</span></div>
      </div>
    </section>

    <section class="section">
      <div class="container split">
        <div class="section-heading reveal">
          <p class="eyebrow">Patient confidence</p>
          <h2>What new patients can expect.</h2>
          <p>Please arrive 15 to 20 minutes before your first visit. We understand that this is an inconvenience, but in order to help your Physical Therapist get to know your injury or illness there are health history forms that need to be filled out, plus obtain your consent to have PTS treat your condition, and we need your consent to bill your insurance.</p>
        </div>
        <div class="card testimonial reveal" data-slider>
          <div class="testimonial-track">
            <article class="testimonial-slide active"><div class="stars">Initial Evaluation</div><p>During your first visit, also known as Initial Evaluation, to understand the gravity of your injury, your Physical Therapist will perform a series of tests to determine the limit of your ability to move or not move, as well as your pain level.</p><strong>New Patients</strong></article>
            <article class="testimonial-slide"><div class="stars">PT and PTA care</div><p>PTS prides itself in knowing that the Physical Therapists (PT) work synchronously with the Physical Therapist Assistant (PTA) to make sure you get the best care we can provide to you so that you can recover in the shortest possible time.</p><strong>New Patients</strong></article>
            <article class="testimonial-slide"><div class="stars">Scheduling</div><p>At the end of your first visit your Physical Therapist will let you know the frequency of your visits per week, then you can work with the Support Staff to plan your future visits.</p><strong>New Patients</strong></article>
          </div>
          <div class="slider-controls"><button class="icon-button" type="button" data-prev aria-label="Previous testimonial">&lt;</button><button class="icon-button" type="button" data-next aria-label="Next testimonial">&gt;</button></div>
        </div>
      </div>
    </section>

    <section class="section soft">
      <div class="container">
        <div class="section-heading reveal">
          <p class="eyebrow">Insurance and first visits</p>
          <h2>Bring your ID, insurance card, medication list, and referral details.</h2>
          <p>New patients should arrive 15 to 20 minutes early to complete forms, consent documents, and insurance information before the initial evaluation.</p>
        </div>
        <div class="logo-grid reveal" aria-label="Insurance support topics">
          <span>Benefit checks</span><span>Prior authorization</span><span>Medicare documentation</span><span>Payment plans</span><span>Text reminders</span>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container split">
        <div class="card card-pad reveal">
          <p class="eyebrow">Visit us</p>
          <h2>1310 Coburg Rd #5, Eugene, OR 97401</h2>
          <p><strong>Phone:</strong> <a href="tel:+15413457532">(541) 345-7532</a><br><strong>Fax:</strong> (541) 345-6692<br><strong>Email:</strong> <a href="mailto:info@ptsclinic.com">info@ptsclinic.com</a></p>
          <p><strong>Hours:</strong> Monday through Friday, 8:00 am to 6:00 pm.</p>
          <a class="btn btn-outline" href="contact.html">Contact and directions</a>
        </div>
        <div class="map reveal">
          <iframe title="Map to Physical Therapy Services in Eugene" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=1310%20Coburg%20Rd%20%235%2C%20Eugene%2C%20OR%2097401&output=embed"></iframe>
        </div>
      </div>
    </section>

    <section class="cta-band">
      <div class="container cta-inner reveal">
        <div><h2>Ready to feel like yourself once more?</h2><p>Contact us today to learn how our exceptional Physical Therapy Clinic can help make you feel like yourself once more.</p></div>
        <a class="btn btn-coral" href="contact.html">Contact Us</a>
      </div>
    </section>
@endsection
