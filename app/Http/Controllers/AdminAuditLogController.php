<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminAuditLogController extends Controller
{
    public function __invoke(Request $request): View|RedirectResponse
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            return redirect()->route('devlogin');
        }

        $selectedCategory = $request->query('category');
        $query = AuditLog::latest();

        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }

        return view('admin.audit-logs', [
            'adminEmail' => Auth::user()->email,
            'logs' => $query->paginate(20)->withQueryString(),
            'categories' => AuditLog::query()->select('category')->distinct()->orderBy('category')->pluck('category'),
            'selectedCategory' => $selectedCategory,
        ]);
    }
}
