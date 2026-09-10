@extends('layouts.public')

@section('title', 'New Patients | Physical Therapy Services Eugene')
@section('description', 'New patient guide for Physical Therapy Services: what to bring, what to expect, insurance information, payment notes, forms, and FAQs.')
@section('canonical', 'https://www.ptsclinic.com/new-patients')
@section('og_title', 'New Patients | Physical Therapy Services')
@section('og_description', 'What to expect before your first PTS visit in Eugene.')
@section('active', 'new-patients')

@section('content')
<section class="page-hero patients-hero"><div class="container reveal"><p class="eyebrow">New Patients</p><h1>New To Physical Therapy Services?</h1><p>So very glad you're here and we are honored that you selected PTS to help you through your recovery!</p></div></section>

    <section class="section">
      <div class="container split">
        <div class="reveal"><p class="eyebrow">Here is some info for first time patients</p><h2>Here are a few items to know, things to bring, and what to expect at your first visit.</h2><p>Please arrive 15 to 20 minutes before your first visit. We understand that this is an inconvenience, but in order to help your Physical Therapist get to know your injury or illness there are health history forms that need to be filled out, plus obtain your consent to have PTS treat your condition, and we need your consent to bill your insurance - all forms need to be filled out by you. And there are a lot of them. Our Physical Therapists would like to spend more time with you, so arriving 15 to 20 minutes earlier than your scheduled visit is greatly appreciated.</p><p>During your first visit, also known as Initial Evaluation, to understand the gravity of your injury, your Physical Therapist will perform a series of tests to determine the limit of your ability to move or not move, as well as your pain level. In the course of these tests, your Physical Therapist will determine what best and appropriate treatment plan for you to aide in your recovery back to normal.</p></div>
        <div class="card card-pad reveal"><h3>Preparation checklist</h3><ul class="check-list"><li>Valid photo ID</li><li>Current health insurance card</li><li>List of prescription and over-the-counter medications</li><li>Referral or physician information, if applicable</li><li>Comfortable clothing for movement testing</li><li>Questions you want to discuss with your therapist</li></ul></div>
      </div>
    </section>

    <section class="section soft">
      <div class="container">
        <div class="section-heading reveal"><p class="eyebrow">Insurance and payment</p><h2>Helpful details before your visit.</h2></div>
        <div class="grid grid-3">
          <article class="card card-pad reveal"><span class="icon">ID</span><h3>Photo ID</h3><p>Due to HIPAA requirements, PTS requires a valid photo ID and keeps a copy in your medical record to help protect against identity theft.</p></article>
          <article class="card card-pad reveal"><span class="icon">INS</span><h3>Insurance card</h3><p>Bring the insurance card provided over the phone so staff can address benefits, eligibility, claims, and authorization questions.</p></article>
          <article class="card card-pad reveal"><span class="icon">RX</span><h3>Medication list</h3><p>Medicare, Medicare Replacement, and Medicare Supplement patients should bring a current medication list with name, dose, and frequency.</p></article>
          <article class="card card-pad reveal"><span class="icon">PA</span><h3>Prior authorization</h3><p>Some insurance companies require prior authorization before additional visits. Approval can take several days.</p></article>
          <article class="card card-pad reveal"><span class="icon">$</span><h3>Payment plans</h3><p>Contact the clinic directly to make arrangements for a payment plan or to discuss payment questions.</p></article>
          <article class="card card-pad reveal"><span class="icon">24</span><h3>Cancellation notice</h3><p>If you need to cancel, call well in advance. Cancellations within 24 hours or one business day may be subject to a cancellation fee.</p></article>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container split">
        <div class="card card-pad reveal"><h2>Required forms</h2><p>New patient forms, consent documents, insurance information, and non-coverage forms should be completed as directed by the clinic.</p><p>For inquiries about your balance, call (508) 422-0233, Monday through Friday, 8:00 am to 5:00 pm EST.</p><a class="btn btn-outline" href="contact.html">Contact the clinic</a></div>
        <div class="accordion reveal" data-accordion>
          <button type="button" aria-expanded="false">How early should I arrive?</button><div class="panel"><div><p>Please arrive 15 to 20 minutes before your first visit to complete intake forms.</p></div></div>
          <button type="button" aria-expanded="false">Will I see a PT or PTA?</button><div class="panel"><div><p>PTS physical therapists and physical therapist assistants work synchronously to provide care. You may be treated by a PT and/or PTA during your plan of care.</p></div></div>
          <button type="button" aria-expanded="false">Will I receive reminders?</button><div class="panel"><div><p>Support staff will explain text reminders, typically sent the afternoon or evening before your next visit.</p></div></div>
          <button type="button" aria-expanded="false">What if authorization is needed?</button><div class="panel"><div><p>Some insurance plans require prior authorization. Calling your insurance company may help expedite the process.</p></div></div>
        </div>
      </div>
    </section>
    <section class="cta-band"><div class="container cta-inner reveal"><div><h2>Have questions before your first visit?</h2><p>Call PTS and the front-office team will help you prepare.</p></div><a class="btn btn-coral" href="tel:+15413457532">Call (541) 345-7532</a></div></section>
@endsection
