<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'public_route',
        'hero_eyebrow',
        'hero_title',
        'hero_subtitle',
        'hero_image_path',
        'body_html',
    ];

    public static function findBySlug(string $slug): self
    {
        $defaults = self::defaults();

        return self::query()->firstOrCreate(
            ['slug' => $slug],
            $defaults[$slug] ?? $defaults['about']
        );
    }

    public static function defaults(): array
    {
        return [
            'home' => [
                'slug' => 'home',
                'name' => 'Home',
                'public_route' => 'home',
                'hero_eyebrow' => 'Home',
                'hero_title' => 'Physical Therapy Services',
                'hero_subtitle' => 'Our goal at Physical Therapy Services is to facilitate healing and restore efficient movement and comfort as quickly as possible. We achieve this through proven hands-on techniques, one-on-one therapy, individualized rehabilitation programs and custom treatment plans designed individually for each patient.',
                'hero_image_path' => 'assets/images/banners/clinic-therapy-banner.png',
                'body_html' => <<<'HTML'
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
      <article class="card card-pad service-card reveal"><span class="icon">PT</span><h3>Physical Therapy</h3><p>Assessment-led care to restore movement and function after injury, illness, surgery, or pain.</p><a href="/services#physical-therapy">Learn more</a></article>
      <article class="card card-pad service-card reveal"><span class="icon">MT</span><h3>Massage Therapy</h3><p>Self-pay and integrated massage options for pain, injury, muscle tightness, and overall discomfort.</p><a href="/massage-therapy">Learn more</a></article>
      <article class="card card-pad service-card reveal"><span class="icon">MA</span><h3>Manual Therapy</h3><p>Hands-on joint and soft-tissue techniques paired with active rehabilitation.</p><a href="/services#manual-therapy">Learn more</a></article>
      <article class="card card-pad service-card reveal"><span class="icon">SP</span><h3>STOTT Pilates</h3><p>Rehabilitation-focused movement training for core control, posture, and resilient motion.</p><a href="/services#stott-pilates">Learn more</a></article>
      <article class="card card-pad service-card reveal"><span class="icon">GT</span><h3>Graston Technique</h3><p>Instrument-assisted soft tissue care that can help address restrictions and mobility limits.</p><a href="/services#graston-technique">Learn more</a></article>
      <article class="card card-pad service-card reveal"><span class="icon">CL</span><h3>Lymphedema and Oncology Rehab</h3><p>Specialized support for swelling, oncology-related impairments, and recovery after treatment.</p><a href="/services#lymphedema-therapy">Learn more</a></article>
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
      <a class="btn btn-outline" href="/contact">Contact and directions</a>
    </div>
    <div class="map reveal">
      <iframe title="Map to Physical Therapy Services in Eugene" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps?q=1310%20Coburg%20Rd%20%235%2C%20Eugene%2C%20OR%2097401&output=embed"></iframe>
    </div>
  </div>
</section>
<section class="cta-band">
  <div class="container cta-inner reveal">
    <div><h2>Ready to feel like yourself once more?</h2><p>Contact us today to learn how our exceptional Physical Therapy Clinic can help make you feel like yourself once more.</p></div>
    <a class="btn btn-coral" href="/contact">Contact Us</a>
  </div>
</section>
HTML,
            ],
            'about' => [
                'slug' => 'about',
                'name' => 'About',
                'public_route' => 'about',
                'hero_eyebrow' => 'About PTS',
                'hero_title' => 'Professional care with a welcoming, family-oriented approach.',
                'hero_subtitle' => 'Physical Therapy Services has helped the Eugene area regain health, wellness, movement, and comfort since 1978.',
                'hero_image_path' => 'assets/images/banners/clinic-therapy-banner.png',
                'body_html' => <<<'HTML'
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
HTML,
            ],
            'services' => [
                'slug' => 'services',
                'name' => 'Services',
                'public_route' => 'services',
                'hero_eyebrow' => 'Services',
                'hero_title' => 'Scientifically validated, evidence-based treatments.',
                'hero_subtitle' => 'We at Physical Therapy Services use a variety of different techniques and modalities such as manual therapy, Stott Pilates, and Graston Technique.',
                'hero_image_path' => 'assets/images/banners/clinic-therapy-banner.png',
                'body_html' => <<<'HTML'
<section class="section">
  <div class="container">
    <div class="section-heading reveal"><p class="eyebrow">Treatment menu</p><h2>Every service includes assessment, treatment, home guidance, and progress checks.</h2></div>
    <div class="grid grid-2">
      <article class="card card-pad service-card reveal" id="physical-therapy"><span class="icon">PT</span><h2>Physical Therapy</h2><p>It is a health care profession that provides treatment to individuals to develop, maintain and restore maximum movement and function throughout life.</p><p>Physical therapy is concerned with identifying and maximizing quality of life and movement potential within promotion, prevention, treatment, and rehabilitation.</p><a href="/contact">Ask about physical therapy</a></article>
      <article class="card card-pad service-card reveal" id="massage-therapy"><span class="icon">MT</span><h2>Massage Therapy</h2><p>Massage therapy can be very effective in helping with injury, muscle tightness, and overall pain.</p><p>There is also a self pay massage therapy option for the public as well as current patients.</p><a href="/massage-therapy">View massage pricing</a></article>
      <article class="card card-pad service-card reveal" id="manual-therapy"><span class="icon">MA</span><h2>Manual Therapy</h2><p>PTS uses a variety of techniques and modalities such as manual therapy, Stott Pilates, and Graston Technique.</p><a href="/contact">Ask about manual therapy</a></article>
      <article class="card card-pad service-card reveal" id="lymphedema-therapy"><span class="icon">LT</span><h2>Lymphedema Therapy</h2><p>Lymphedema is the accumulation of lymphatic fluid in one or more parts of the body. PTS treats lymphedema with education, therapeutic exercise, manual lymphatic drainage, and appropriate compression.</p><a href="/contact">Ask about lymphedema care</a></article>
      <article class="card card-pad service-card reveal" id="oncology-rehabilitation"><span class="icon">ON</span><h2>Oncology Physical Therapy</h2><p>Physical therapy can help restore mobility, reduce pain, improve energy, and improve quality of life for those experiencing effects from cancer and cancer treatment.</p><a href="/contact">Ask about oncology physical therapy</a></article>
      <article class="card card-pad service-card reveal" id="personalized-treatment"><span class="icon">1:1</span><h2>Personalized Treatment Programs</h2><p>Custom plans are designed individually for each patient and condition.</p><a href="/contact">Ask about custom plans</a></article>
    </div>
  </div>
</section>
HTML,
            ],
            'massage' => [
                'slug' => 'massage',
                'name' => 'Massage',
                'public_route' => 'massage-therapy',
                'hero_eyebrow' => 'Massage therapy',
                'hero_title' => 'Targeted massage for injury, muscle tightness, and overall pain.',
                'hero_subtitle' => 'PTS includes manual therapy in treatment when appropriate and offers self-pay massage therapy options for current patients and the public.',
                'hero_image_path' => 'assets/images/banners/clinic-therapy-banner.png',
                'body_html' => <<<'HTML'
<section class="section">
  <div class="container split">
    <div class="reveal">
      <p class="eyebrow">Service overview</p>
      <h2>Massage Therapy</h2>
      <p>Massage therapy can be very effective in helping with injury, muscle tightness, and overall pain. PTS includes manual therapy in treatment when clinically appropriate.</p>
      <p>There is also a self pay massage therapy option for the public as well as current patients.</p>
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
  </div>
</section>
HTML,
            ],
            'new-patients' => [
                'slug' => 'new-patients',
                'name' => 'New Patients',
                'public_route' => 'new-patients',
                'hero_eyebrow' => 'New Patients',
                'hero_title' => 'New To Physical Therapy Services?',
                'hero_subtitle' => "So very glad you're here and we are honored that you selected PTS to help you through your recovery!",
                'hero_image_path' => 'assets/images/banners/clinic-therapy-banner.png',
                'body_html' => <<<'HTML'
<section class="section">
  <div class="container split">
    <div class="reveal"><p class="eyebrow">Here is some info for first time patients</p><h2>Here are a few items to know, things to bring, and what to expect at your first visit.</h2><p>Please arrive 15 to 20 minutes before your first visit to complete health history forms, consent forms, and insurance paperwork.</p><p>During your first visit, your Physical Therapist will perform tests to understand your injury, movement limits, and pain level, then determine the most appropriate treatment plan.</p></div>
    <div class="card card-pad reveal"><h3>Preparation checklist</h3><ul class="check-list"><li>Valid photo ID</li><li>Current health insurance card</li><li>Medication list</li><li>Referral or physician information, if applicable</li><li>Comfortable clothing</li><li>Questions for your therapist</li></ul></div>
  </div>
</section>
<section class="section soft">
  <div class="container">
    <div class="section-heading reveal"><p class="eyebrow">Insurance and payment</p><h2>Helpful details before your visit.</h2></div>
    <div class="grid grid-3">
      <article class="card card-pad reveal"><span class="icon">ID</span><h3>Photo ID</h3><p>Due to HIPAA requirements, PTS requires a valid photo ID.</p></article>
      <article class="card card-pad reveal"><span class="icon">INS</span><h3>Insurance card</h3><p>Bring your insurance card so staff can address benefits, eligibility, claims, and authorization questions.</p></article>
      <article class="card card-pad reveal"><span class="icon">RX</span><h3>Medication list</h3><p>Bring a current medication list with name, dose, and frequency.</p></article>
    </div>
  </div>
</section>
HTML,
            ],
        ];
    }

    public function heroImageUrl(): string
    {
        if (str_starts_with($this->hero_image_path ?? '', 'cms-pages/')) {
            return asset('storage/'.$this->hero_image_path);
        }

        return asset($this->hero_image_path ?: 'assets/images/banners/clinic-therapy-banner.png');
    }

    public function visibleBodyHtml(): string
    {
        $bodyHtml = html_entity_decode($this->body_html ?? '');

        return preg_replace('/<section\b(?=[^>]*\sdata-cms-hidden=(["\'])true\1)[^>]*>.*?<\/section>/is', '', $bodyHtml) ?? $bodyHtml;
    }
}
