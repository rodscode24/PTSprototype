<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use App\Models\ContactPageSetting;
use App\Models\AuditLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminContactController extends Controller
{
    public function __invoke(Request $request): View|RedirectResponse
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            return redirect()->route('devlogin');
        }

        $recentInquiries = ContactInquiry::latest()->paginate(10);
        $totalInquiries = ContactInquiry::count();
        $latestInquiry = ContactInquiry::latest()->first();
        $contactSettings = ContactPageSetting::current();

        return view('admin.contact-form', [
            'adminEmail' => Auth::user()->email,
            'recentInquiries' => $recentInquiries,
            'totalInquiries' => $totalInquiries,
            'latestInquiry' => $latestInquiry,
            'contactSettings' => $contactSettings,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            return redirect()->route('devlogin');
        }

        $validated = $request->validate([
            'hero_eyebrow' => ['required', 'string', 'max:120'],
            'hero_title' => ['required', 'string', 'max:120'],
            'hero_subtitle' => ['required', 'string', 'max:220'],
            'hero_image' => ['nullable', 'image', 'max:4096'],
            'contact_heading' => ['required', 'string', 'max:120'],
            'notice' => ['required', 'string', 'max:1000'],
            'phone' => ['required', 'string', 'max:80'],
            'fax' => ['nullable', 'string', 'max:80'],
            'public_email' => ['required', 'email:rfc', 'max:254'],
            'address' => ['required', 'string', 'max:500'],
            'hours' => ['required', 'string', 'max:700'],
        ]);

        $settings = ContactPageSetting::current();

        if ($request->hasFile('hero_image')) {
            $validated['hero_image_path'] = $request->file('hero_image')->store('contact', 'public');
        }

        unset($validated['hero_image']);

        $before = $settings->only(array_keys($validated));
        $settings->update($validated);
        AuditLog::record('Contact Form', 'Updated contact page content', $settings, $before, $settings->fresh()->only(array_keys($validated)));

        return redirect()
            ->route('admin.contact')
            ->with('status', 'Contact page content updated successfully.');
    }
}
