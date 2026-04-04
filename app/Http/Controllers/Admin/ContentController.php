<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;

class ContentController extends Controller
{
    public function edit()
    {
        $profile = Profile::query()->first() ?? Profile::create();
        return view('admin.content.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::query()->first() ?? Profile::create();

        $validatedData = $request->validate([
            'hero_headline' => 'nullable|string|max:255',
            'alternating_text' => 'nullable|string',
            'about_text' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
        ]);

        if ($request->hasFile('hero_image')) {
            $validatedData['hero_image'] = $request->file('hero_image')->store('uploads/content', 'public');
            if ($profile->hero_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->hero_image);
            }
        }

        $profile->update($validatedData);

        return redirect()->route('admin.content.edit')->with('status', 'Content updated successfully.');
    }
}
