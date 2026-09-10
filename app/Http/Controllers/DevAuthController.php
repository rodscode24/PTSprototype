<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DevAuthController extends Controller
{
    public function create(): View
    {
        return view('admin.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:rfc'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'is_admin' => true,
        ], $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()
            ->withErrors(['email' => 'These login details do not match the dev admin account.'])
            ->onlyInput('email');
    }

    public function forgot(): View
    {
        return view('admin.forgot-password');
    }

    public function sendResetHelp(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email:rfc'],
        ]);

        Log::info('Dev admin password help requested.', [
            'email' => $validated['email'],
            'requested_at' => now()->toIso8601String(),
        ]);

        return back()->with('status', 'If this email belongs to the dev admin account, password help has been recorded.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('devlogin');
    }
}
