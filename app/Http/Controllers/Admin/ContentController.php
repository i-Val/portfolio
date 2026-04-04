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
        ]);

        $profile->update($validatedData);

        return redirect()->route('admin.content.edit')->with('status', 'Content updated successfully.');
    }
}
