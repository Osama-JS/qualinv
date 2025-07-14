<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of team members
     */
    public function index()
    {
        $teamMembers = TeamMember::orderBy('sort_order')->get();
        return view('admin.team-members.index', compact('teamMembers'));
    }

    /**
     * Show the form for creating a new team member
     */
    public function create()
    {
        return view('admin.team-members.create');
    }

    /**
     * Store a newly created team member
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'position_en' => 'required|string|max:255',
            'position_ar' => 'required|string|max:255',
            'bio_en' => 'nullable|string',
            'bio_ar' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $teamMember = new TeamMember();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('team-members', 'public');
            $teamMember->photo = $photoPath;
        }

        $teamMember->name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $teamMember->position = [
            'en' => $request->position_en,
            'ar' => $request->position_ar,
        ];

        $teamMember->bio = [
            'en' => $request->bio_en,
            'ar' => $request->bio_ar,
        ];

        $teamMember->email = $request->email;
        $teamMember->phone = $request->phone;
        $teamMember->sort_order = $request->sort_order ?? 0;
        $teamMember->is_active = true;

        $teamMember->save();

        return redirect()->route('admin.team-members.index')
            ->with('success', __('admin.success_created'));
    }

    /**
     * Show the form for editing a team member
     */
    public function edit(TeamMember $teamMember)
    {
        return view('admin.team-members.edit', compact('teamMember'));
    }

    /**
     * Update the specified team member
     */
    public function update(Request $request, TeamMember $teamMember)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'position_en' => 'required|string|max:255',
            'position_ar' => 'required|string|max:255',
            'bio_en' => 'nullable|string',
            'bio_ar' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($teamMember->photo && Storage::disk('public')->exists($teamMember->photo)) {
                Storage::disk('public')->delete($teamMember->photo);
            }

            $photoPath = $request->file('photo')->store('team-members', 'public');
            $teamMember->photo = $photoPath;
        }

        $teamMember->name = [
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ];

        $teamMember->position = [
            'en' => $request->position_en,
            'ar' => $request->position_ar,
        ];

        $teamMember->bio = [
            'en' => $request->bio_en,
            'ar' => $request->bio_ar,
        ];

        $teamMember->email = $request->email;
        $teamMember->phone = $request->phone;
        $teamMember->sort_order = $request->sort_order ?? 0;
        $teamMember->is_active = $request->has('is_active');

        $teamMember->save();

        return redirect()->route('admin.team-members.index')
            ->with('success', __('admin.success_updated'));
    }

    /**
     * Remove the specified team member
     */
    public function destroy(TeamMember $teamMember)
    {
        // Delete photo if exists
        if ($teamMember->photo && Storage::disk('public')->exists($teamMember->photo)) {
            Storage::disk('public')->delete($teamMember->photo);
        }

        $teamMember->delete();

        return redirect()->route('admin.team-members.index')
            ->with('success', __('admin.success_deleted'));
    }
}
