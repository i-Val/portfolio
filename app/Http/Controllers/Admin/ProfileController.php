<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::query()->first() ?? Profile::create([
            'name' => 'Your Name',
        ]);

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::query()->first() ?? Profile::create([
            'name' => 'Your Name',
        ]);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'birthdate' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'show_birthdate' => ['nullable', 'boolean'],
            'show_name' => ['nullable', 'boolean'],
            'show_headline' => ['nullable', 'boolean'],
            'show_phone' => ['nullable', 'boolean'],
            'show_location' => ['nullable', 'boolean'],
            'show_email' => ['nullable', 'boolean'],
            'avatar' => ['nullable', 'image', 'max:4096'],
            'about_image' => ['nullable', 'image', 'max:4096'],
            'resume_url' => ['nullable', 'string', 'max:2048'],
            'github_url' => ['nullable', 'string', 'max:2048'],
            'linkedin_url' => ['nullable', 'string', 'max:2048'],
            'twitter_url' => ['nullable', 'string', 'max:2048'],
        ]);

        foreach (['show_birthdate', 'show_name', 'show_headline', 'show_phone', 'show_location', 'show_email'] as $flag) {
            if ($request->has($flag)) {
                $validated[$flag] = $request->boolean($flag);
            }
        }

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('uploads/profile', 'public');
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }
        }

        if ($request->hasFile('about_image')) {
            $validated['about_image'] = $request->file('about_image')->store('uploads/profile', 'public');
            if ($profile->about_image) {
                Storage::disk('public')->delete($profile->about_image);
            }
        }

        $profile->update($validated);

        return redirect()->route('admin.profile.edit')->with('status', 'Profile updated.');
    }
}
