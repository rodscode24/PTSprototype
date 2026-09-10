<?php

namespace Tests\Feature;

use App\Mail\GeneralContactInquiryMail;
use App\Models\AuditLog;
use App\Models\ContactInquiry;
use App\Models\ContactPageSetting;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_public_pages_are_available(): void
    {
        foreach ([
            '/', '/about', '/services', '/physical-therapy', '/massage-therapy',
            '/team', '/new-patients', '/contact',
        ] as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_general_contact_inquiry_is_accepted(): void
    {
        Mail::fake();

        $response = $this->postJson('/contact', [
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'phone' => '541-555-0100',
            'subject' => 'General question',
            'message' => 'Please call me about a general, non-confidential question.',
            'website' => '',
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('reference', 'GCI1');

        $this->assertDatabaseHas('contact_inquiries', [
            'identifier' => 'GCI1',
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'sent_to' => 'rodscode24@gmail.com',
        ]);

        Mail::assertSent(GeneralContactInquiryMail::class, function (GeneralContactInquiryMail $mail): bool {
            return $mail->inquiry->identifier === 'GCI1'
                && $mail->inquiry->sent_to === 'rodscode24@gmail.com'
                && $mail->envelope()->subject === 'GCI1 - General question';
        });
    }

    public function test_general_contact_inquiry_identifier_increments(): void
    {
        Mail::fake();

        ContactInquiry::create([
            'identifier' => 'GCI1',
            'first_name' => 'First',
            'last_name' => 'Visitor',
            'email' => 'first@example.com',
            'phone' => null,
            'subject' => 'Previous inquiry',
            'message' => 'Existing inquiry.',
            'sent_to' => 'rodscode24@gmail.com',
        ]);

        $this->postJson('/contact', [
            'first_name' => 'Second',
            'last_name' => 'Visitor',
            'email' => 'second@example.com',
            'phone' => '',
            'subject' => 'Next inquiry',
            'message' => 'This should receive the next identifier.',
            'website' => '',
        ])
            ->assertOk()
            ->assertJsonPath('reference', 'GCI2');

        $this->assertDatabaseHas('contact_inquiries', [
            'identifier' => 'GCI2',
            'email' => 'second@example.com',
        ]);
    }

    public function test_dev_login_area_is_available_and_hidden_from_public_pages(): void
    {
        $this->get('/devlogin')
            ->assertOk()
            ->assertSee('Developer login');

        $this->get('/')
            ->assertOk()
            ->assertDontSee('/devlogin');
    }

    public function test_admin_dashboard_requires_dev_login(): void
    {
        $this->get('/admin/dashboard')
            ->assertRedirect('/devlogin');
    }

    public function test_admin_contact_form_page_requires_dev_login(): void
    {
        $this->get('/admin/contact-form')
            ->assertRedirect('/devlogin');
    }

    public function test_admin_cms_pages_require_dev_login(): void
    {
        foreach (['home', 'about', 'services', 'massage', 'new-patients'] as $slug) {
            $this->get('/admin/pages/'.$slug)
                ->assertRedirect('/devlogin');
        }
    }

    public function test_admin_team_page_requires_dev_login(): void
    {
        $this->get('/admin/team')
            ->assertRedirect('/devlogin');
    }

    public function test_admin_audit_log_requires_dev_login(): void
    {
        $this->get('/admin/audit-log')
            ->assertRedirect('/devlogin');
    }

    public function test_dev_admin_can_login_and_view_dashboard(): void
    {
        User::factory()->create([
            'name' => 'PTS Admin',
            'email' => config('dev_admin.email'),
            'password' => Hash::make(config('dev_admin.password')),
            'is_admin' => true,
        ]);

        $this->post('/devlogin', [
            'email' => config('dev_admin.email'),
            'password' => config('dev_admin.password'),
        ])->assertRedirect(route('admin.dashboard'));

        $this->get('/admin/dashboard')
            ->assertOk()
            ->assertSee('Admin dashboard');
    }

    public function test_dev_admin_can_view_contact_form_cms_page(): void
    {
        User::factory()->create([
            'name' => 'PTS Admin',
            'email' => config('dev_admin.email'),
            'password' => Hash::make(config('dev_admin.password')),
            'is_admin' => true,
        ]);

        $this->post('/devlogin', [
            'email' => config('dev_admin.email'),
            'password' => config('dev_admin.password'),
        ])->assertRedirect(route('admin.dashboard'));

        $this->get('/admin/contact-form')
            ->assertOk()
            ->assertSee('Contact Form CMS')
            ->assertSee('General contact form')
            ->assertSee('Live database');
    }

    public function test_dev_admin_can_update_contact_page_content(): void
    {
        User::factory()->create([
            'name' => 'PTS Admin',
            'email' => config('dev_admin.email'),
            'password' => Hash::make(config('dev_admin.password')),
            'is_admin' => true,
        ]);

        $this->post('/devlogin', [
            'email' => config('dev_admin.email'),
            'password' => config('dev_admin.password'),
        ])->assertRedirect(route('admin.dashboard'));

        $this->put('/admin/contact-form', [
            'hero_eyebrow' => 'Updated Contact',
            'hero_title' => 'Reach Our Team',
            'hero_subtitle' => 'Updated contact page subtitle.',
            'contact_heading' => 'Contact PTS',
            'notice' => 'Updated notice for testing.',
            'phone' => '(541) 555-0199',
            'fax' => '(541) 555-0101',
            'public_email' => 'frontdesk@example.com',
            'address' => "123 Clinic Way\nEugene, OR",
            'hours' => "Monday to Friday\n8am to 5pm",
        ])->assertRedirect(route('admin.contact'));

        $this->assertDatabaseHas('contact_page_settings', [
            'hero_title' => 'Reach Our Team',
            'public_email' => 'frontdesk@example.com',
        ]);

        $this->get('/contact')
            ->assertOk()
            ->assertSee('Reach Our Team')
            ->assertSee('frontdesk@example.com');
    }

    public function test_dev_admin_can_view_and_update_shared_cms_pages(): void
    {
        Storage::fake('public');

        User::factory()->create([
            'name' => 'PTS Admin',
            'email' => config('dev_admin.email'),
            'password' => Hash::make(config('dev_admin.password')),
            'is_admin' => true,
        ]);

        $this->post('/devlogin', [
            'email' => config('dev_admin.email'),
            'password' => config('dev_admin.password'),
        ])->assertRedirect(route('admin.dashboard'));

        $this->get('/admin/pages/about')
            ->assertOk()
            ->assertSee('About page CMS')
            ->assertDontSee('Page body content');

        $this->get('/admin/pages/home')
            ->assertOk()
            ->assertSee('Home page CMS')
            ->assertSee('Edit banner')
            ->assertDontSee('Banner eyebrow')
            ->assertSee('Helping patients in the Eugene area regain health and wellness since 1978.');

        $this->put('/admin/pages/home', [
            'hero_eyebrow' => 'Home',
            'hero_title' => 'Physical Therapy Services',
            'hero_subtitle' => '',
            'body_html' => '<section class="section"><div class="container"><h2>Home CMS body</h2><p>Saved with an empty subtitle.</p></div></section>',
        ])->assertRedirect(route('admin.cms.edit', 'home'));

        $this->get('/')
            ->assertOk()
            ->assertSee('Home CMS body')
            ->assertSee('Saved with an empty subtitle.');

        $this->put('/admin/pages/about', [
            'hero_eyebrow' => 'About PTS Updated',
            'hero_title' => 'Updated About Page',
            'hero_subtitle' => 'Updated about subtitle.',
            'body_html' => '<section class="section"><div class="container"><h2>Updated body content</h2><p>Saved from admin CMS.</p></div></section>',
        ])->assertRedirect(route('admin.cms.edit', 'about'));

        $this->get('/about')
            ->assertOk()
            ->assertSee('Updated About Page')
            ->assertSee('Updated body content');

        $this->put('/admin/pages/about', [
            'hero_eyebrow' => 'About PTS Updated',
            'hero_title' => 'Updated About Page',
            'hero_subtitle' => 'Updated about subtitle.',
            'body_html' => '<section class="section"><div class="container"><h2>Visible CMS section</h2></div></section><section class="section" data-cms-hidden="true"><div class="container"><h2>Hidden CMS section</h2></div></section>',
        ])->assertRedirect(route('admin.cms.edit', 'about'));

        $this->get('/about')
            ->assertOk()
            ->assertSee('Visible CMS section')
            ->assertDontSee('Hidden CMS section');

        $this->get('/admin/pages/about')
            ->assertOk()
            ->assertSee('Hidden CMS section')
            ->assertSee('Hidden on public site')
            ->assertSee('Visible on public site')
            ->assertSee('Show section');

        $longSubtitle = str_repeat('Long subtitle text. ', 24);

        $this->put('/admin/pages/about', [
            'hero_eyebrow' => 'About PTS Updated',
            'hero_title' => 'Updated About Page',
            'hero_subtitle' => $longSubtitle,
            'body_html' => '<section class="section"><div class="container"><h2>Long subtitle save check</h2></div></section>',
        ])->assertRedirect(route('admin.cms.edit', 'about'));

        $this->put('/admin/pages/about', [
            'hero_eyebrow' => 'About PTS Updated',
            'hero_title' => 'Updated About Page',
            'hero_subtitle' => 'Updated about subtitle.',
            'body_html' => '<section class="section mint"><div class="container"><div class="grid grid-3"><div class="card image-panel reveal"><div class="owned-visual gallery-visual" data-upload-token="section-image-0"><span>Treatment rooms</span></div></div></div></div></section>',
            'section_images' => [
                'section-image-0' => new UploadedFile(public_path('assets/images/logos/pts-nav-logo.png'), 'treatment-room.png', 'image/png', null, true),
            ],
        ])->assertRedirect(route('admin.cms.edit', 'about'));

        $this->get('/about')
            ->assertOk()
            ->assertSee('/storage/cms-pages', false)
            ->assertSee('background-size: cover', false)
            ->assertDontSee('data-upload-token', false);
    }

    public function test_dev_admin_can_add_and_update_team_members(): void
    {
        User::factory()->create([
            'name' => 'PTS Admin',
            'email' => config('dev_admin.email'),
            'password' => Hash::make(config('dev_admin.password')),
            'is_admin' => true,
        ]);

        $this->post('/devlogin', [
            'email' => config('dev_admin.email'),
            'password' => config('dev_admin.password'),
        ])->assertRedirect(route('admin.dashboard'));

        $this->get('/admin/team')
            ->assertOk()
            ->assertSee('Team Members')
            ->assertSee('Add new team member');

        $this->post('/admin/team', [
            'name' => 'Alex Therapist',
            'credentials' => 'PT Assistant',
            'bio' => 'Alex helps patients feel supported during rehabilitation.',
            'sort_order' => 50,
            'is_active' => '1',
        ])->assertRedirect(route('admin.team'));

        $member = TeamMember::where('name', 'Alex Therapist')->firstOrFail();

        $this->put('/admin/team/'.$member->id, [
            'name' => 'Alex Updated',
            'credentials' => 'PTA',
            'bio' => 'Updated bio from the team CMS.',
            'sort_order' => 2,
            'is_active' => '1',
        ])->assertRedirect(route('admin.team'));

        $this->assertDatabaseHas('team_members', [
            'id' => $member->id,
            'name' => 'Alex Updated',
            'credentials' => 'PTA',
            'bio' => 'Updated bio from the team CMS.',
            'is_active' => true,
        ]);

        $this->get('/team')
            ->assertOk()
            ->assertSee('Alex Updated')
            ->assertSee('Updated bio from the team CMS.');

        $this->assertDatabaseHas('audit_logs', [
            'category' => 'Team',
            'action' => 'Added team member',
            'subject_name' => 'Alex Therapist',
        ]);

        $this->assertDatabaseHas('audit_logs', [
            'category' => 'Team',
            'action' => 'Updated team member profile',
            'subject_name' => 'Alex Updated',
        ]);
    }

    public function test_dev_admin_can_view_audit_log_by_category(): void
    {
        User::factory()->create([
            'name' => 'PTS Admin',
            'email' => config('dev_admin.email'),
            'password' => Hash::make(config('dev_admin.password')),
            'is_admin' => true,
        ]);

        $this->post('/devlogin', [
            'email' => config('dev_admin.email'),
            'password' => config('dev_admin.password'),
        ])->assertRedirect(route('admin.dashboard'));

        AuditLog::create([
            'user_email' => config('dev_admin.email'),
            'category' => 'Services',
            'action' => 'Updated Services page content',
            'subject_name' => 'Services',
            'changes' => ['hero_title' => ['before' => 'Old', 'after' => 'New']],
        ]);

        $this->get('/admin/audit-log?category=Services')
            ->assertOk()
            ->assertSee('Audit Log')
            ->assertSee('Services')
            ->assertSee('Updated Services page content')
            ->assertSee('Hero Title');
    }

    public function test_forgot_password_page_accepts_dev_admin_help_request(): void
    {
        $this->get('/devlogin/forgot-password')
            ->assertOk()
            ->assertSee('Forgot password');

        $this->post('/devlogin/forgot-password', [
            'email' => config('dev_admin.email'),
        ])->assertSessionHas('status');
    }
}
