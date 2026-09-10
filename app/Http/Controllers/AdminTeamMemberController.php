<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminTeamMemberController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            return redirect()->route('devlogin');
        }

        return view('admin.team', [
            'adminEmail' => Auth::user()->email,
            'teamMembers' => TeamMember::query()->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            return redirect()->route('devlogin');
        }

        $validated = $this->validated($request);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('team', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $member = TeamMember::create($validated);
        AuditLog::record('Team', 'Added team member', $member, [], $member->only(['name', 'credentials', 'bio', 'image_path', 'sort_order', 'is_active']));

        return redirect()->route('admin.team')->with('status', 'Team member added successfully.');
    }

    public function update(Request $request, TeamMember $teamMember): RedirectResponse
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            return redirect()->route('devlogin');
        }

        $validated = $this->validated($request);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('team', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $before = $teamMember->only(array_keys($validated));
        $teamMember->update($validated);
        AuditLog::record('Team', 'Updated team member profile', $teamMember, $before, $teamMember->fresh()->only(array_keys($validated)));

        return redirect()->route('admin.team')->with('status', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            return redirect()->route('devlogin');
        }

        AuditLog::record('Team', 'Removed team member', $teamMember, $teamMember->only(['name', 'credentials', 'bio', 'image_path', 'sort_order', 'is_active']), []);
        $teamMember->delete();

        return redirect()->route('admin.team')->with('status', 'Team member removed successfully.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'credentials' => ['nullable', 'string', 'max:180'],
            'bio' => ['required', 'string', 'max:4000'],
            'image' => ['nullable', 'image', 'max:4096'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:999'],
        ]);
    }
}
