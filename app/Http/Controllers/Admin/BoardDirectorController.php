<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardDirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardDirectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of board directors
     */
    public function index(Request $request)
    {
        $query = BoardDirector::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereRaw("JSON_EXTRACT(name, '$.en') LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("JSON_EXTRACT(name, '$.ar') LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("JSON_EXTRACT(position, '$.en') LIKE ?", ["%{$search}%"])
                  ->orWhereRaw("JSON_EXTRACT(position, '$.ar') LIKE ?", ["%{$search}%"])
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }

        // Sort
        $sortBy = $request->get('sort', 'sort_order');
        switch ($sortBy) {
            case 'name':
                $query->orderByRaw("JSON_EXTRACT(name, '$.en') ASC");
                break;
            case 'created_at':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('sort_order');
                break;
        }

        $boardDirectors = $query->paginate(15);

        return view('admin.board-directors.index', compact('boardDirectors'));
    }

    /**
     * Show the form for creating a new board director
     */
    public function create()
    {
        return view('admin.board-directors.create');
    }

    /**
     * Store a newly created board director
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
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'position' => [
                'en' => $request->position_en,
                'ar' => $request->position_ar,
            ],
            'bio' => [
                'en' => $request->bio_en,
                'ar' => $request->bio_ar,
            ],
            'contact_info' => [
                'email' => $request->email,
                'phone' => $request->phone,
            ],
            'social_media' => [
                'linkedin' => $request->linkedin_url,
                'twitter' => $request->twitter_url,
                'facebook' => $request->facebook_url,
                'instagram' => $request->instagram_url,
            ],
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('board-directors', 'public');
        }

        BoardDirector::create($data);

        return redirect()->route('admin.board-directors.index')
            ->with('success', __('admin.board_director_created_successfully'));
    }

    /**
     * Display the specified board director
     */
    public function show(BoardDirector $boardDirector)
    {
        return view('admin.board-directors.show', compact('boardDirector'));
    }

    /**
     * Show the form for editing the specified board director
     */
    public function edit(BoardDirector $boardDirector)
    {
        return view('admin.board-directors.edit', compact('boardDirector'));
    }

    /**
     * Update the specified board director
     */
    public function update(Request $request, BoardDirector $boardDirector)
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

        $data = [
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'position' => [
                'en' => $request->position_en,
                'ar' => $request->position_ar,
            ],
            'bio' => [
                'en' => $request->bio_en,
                'ar' => $request->bio_ar,
            ],
            'email' => $request->email,
            'phone' => $request->phone,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($boardDirector->photo) {
                Storage::disk('public')->delete($boardDirector->photo);
            }
            $data['photo'] = $request->file('photo')->store('board-directors', 'public');
        }

        $boardDirector->update($data);

        return redirect()->route('admin.board-directors.index')
            ->with('success', __('admin.board_director_updated_successfully'));
    }

    /**
     * Remove the specified board director
     */
    public function destroy(BoardDirector $boardDirector)
    {
        // Delete photo if exists
        if ($boardDirector->photo) {
            Storage::disk('public')->delete($boardDirector->photo);
        }

        $boardDirector->delete();

        return redirect()->route('admin.board-directors.index')
            ->with('success', __('admin.board_director_deleted_successfully'));
    }
}
