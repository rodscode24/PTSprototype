<?php

namespace App\Http\Controllers;

use App\Models\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(Request $request): View|RedirectResponse
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            return redirect()->route('devlogin');
        }

        $totalInquiries = ContactInquiry::count();
        $latestInquiry = ContactInquiry::latest()->first();
        $recentInquiries = ContactInquiry::latest()->take(8)->get();

        return view('admin.dashboard', [
            'adminEmail' => Auth::user()->email,
            'totalInquiries' => $totalInquiries,
            'latestInquiry' => $latestInquiry,
            'recentInquiries' => $recentInquiries,
        ]);
    }
}
