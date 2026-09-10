<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\View\View;

class PublicTeamController extends Controller
{
    public function __invoke(): View
    {
        if (TeamMember::query()->count() === 0) {
            TeamMember::seedDefaults();
        }

        return view('pages.team', [
            'teamMembers' => TeamMember::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ]);
    }
}
