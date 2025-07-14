<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    /**
     * Show the user's profile page
     */
    public function index(): View
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Show the form for editing the user's profile
     */
    public function edit(): View
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information
     */
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^[\+]?[0-9\s\-\(\)]+$/'],
            'bio' => ['nullable', 'string', 'max:500'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'name.required' => __('validation.profile_name_required'),
            'name.min' => __('validation.profile_name_min'),
            'name.max' => __('validation.profile_name_max'),
            'email.required' => __('validation.profile_email_required'),
            'email.email' => __('validation.profile_email_format'),
            'email.unique' => __('validation.profile_email_unique'),
            'phone.regex' => __('validation.profile_phone_format'),
            'bio.max' => __('validation.profile_bio_max'),
            'avatar.image' => __('validation.profile_avatar_image'),
            'avatar.mimes' => __('validation.profile_avatar_mimes'),
            'avatar.max' => __('validation.profile_avatar_max'),
        ]);

        try {
            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete old avatar if exists
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }

                // Store new avatar
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $validated['avatar'] = $avatarPath;
            }

            // Update user profile
            $user->update($validated);

            return redirect()->route('admin.profile.index')
                           ->with('success', __('admin.profile_updated_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', __('admin.profile_update_failed'));
        }
    }

    /**
     * Show the form for changing password
     */
    public function showChangePasswordForm(): View
    {
        return view('admin.profile.change-password');
    }

    /**
     * Update the user's password
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => __('validation.current_password_required'),
            'password.required' => __('validation.new_password_required'),
            'password.min' => __('validation.new_password_min'),
            'password.confirmed' => __('validation.new_password_confirmed'),
        ]);

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()
                           ->withErrors(['current_password' => __('validation.current_password_incorrect')])
                           ->withInput();
        }

        try {
            // Update password
            $user->update([
                'password' => Hash::make($validated['password'])
            ]);

            return redirect()->route('admin.profile.index')
                           ->with('success', __('admin.password_updated_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', __('admin.password_update_failed'));
        }
    }

    /**
     * Upload avatar via AJAX
     */
    public function uploadAvatar(Request $request): JsonResponse
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        try {
            $user = Auth::user();

            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            
            // Update user avatar
            $user->update(['avatar' => $avatarPath]);

            return response()->json([
                'success' => true,
                'message' => __('admin.avatar_updated_successfully'),
                'avatar_url' => Storage::url($avatarPath)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('admin.avatar_update_failed')
            ], 500);
        }
    }

    /**
     * Delete user avatar
     */
    public function deleteAvatar(): JsonResponse
    {
        try {
            $user = Auth::user();

            // Delete avatar file if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Remove avatar from user record
            $user->update(['avatar' => null]);

            return response()->json([
                'success' => true,
                'message' => __('admin.avatar_deleted_successfully')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('admin.avatar_delete_failed')
            ], 500);
        }
    }
}
