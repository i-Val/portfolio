<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SiteSettingsController extends Controller
{
    public function edit(): View
    {
        $profile = Profile::query()->first() ?? Profile::create([
            'name' => 'Your Name',
        ]);

        return view('admin.site-settings.edit', compact('profile'));
    }

    public function update(Request $request): RedirectResponse
    {
        $profile = Profile::query()->first() ?? Profile::create([
            'name' => 'Your Name',
        ]);

        $validated = $request->validate([
            'location' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:4096'],
            'favicon' => ['nullable', 'image', 'mimes:ico,png,jpg,jpeg,svg', 'max:2048'],
            'show_logo' => ['nullable', 'boolean'],
            'github_url' => ['nullable', 'url', 'max:2048'],
            'linkedin_url' => ['nullable', 'url', 'max:2048'],
            'twitter_url' => ['nullable', 'url', 'max:2048'],
            'facebook_url' => ['nullable', 'url', 'max:2048'],
            'instagram_url' => ['nullable', 'url', 'max:2048'],
            'youtube_url' => ['nullable', 'url', 'max:2048'],
            'dribbble_url' => ['nullable', 'url', 'max:2048'],
            'google_plus_url' => ['nullable', 'url', 'max:2048'],
            'maintenance_enabled' => ['nullable', 'boolean'],
            'maintenance_message' => ['nullable', 'string', 'max:10000'],
        ]);

        $validated['maintenance_enabled'] = (bool) ($validated['maintenance_enabled'] ?? false);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('uploads/branding', 'public');
            if ($profile->logo) {
                Storage::disk('public')->delete($profile->logo);
            }
        }

        if ($request->hasFile('favicon')) {
            $validated['favicon'] = $request->file('favicon')->store('uploads/branding', 'public');
            if ($profile->favicon) {
                Storage::disk('public')->delete($profile->favicon);
            }
        }

        $validated['show_logo'] = $request->has('show_logo');

        $profile->update($validated);

        return back()->with('status', 'Settings updated.');
    }
}
