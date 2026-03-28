<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(50);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:projects,slug'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'project_url' => ['nullable', 'string', 'max:2048'],
            'category' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $validated['is_featured'] = (bool) ($validated['is_featured'] ?? false);
        $validated['slug'] = $this->generateUniqueSlug($validated['slug'] ?: Str::slug($validated['title']));

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads/projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('status', 'Portfolio item created.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:projects,slug,'.$project->id],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'project_url' => ['nullable', 'string', 'max:2048'],
            'category' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $validated['is_featured'] = (bool) ($validated['is_featured'] ?? false);
        $validated['slug'] = $this->generateUniqueSlug($validated['slug'] ?: Str::slug($validated['title']), $project->id);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads/projects', 'public');
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('status', 'Portfolio item updated.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('status', 'Portfolio item deleted.');
    }

    private function generateUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $slug = Str::slug($slug);
        $base = $slug ?: Str::random(8);

        $query = Project::query()->where('slug', $base);
        if ($ignoreId !== null) {
            $query->whereKeyNot($ignoreId);
        }

        if (! $query->exists()) {
            return $base;
        }

        $i = 2;
        while (true) {
            $candidate = $base.'-'.$i;
            $query = Project::query()->where('slug', $candidate);
            if ($ignoreId !== null) {
                $query->whereKeyNot($ignoreId);
            }
            if (! $query->exists()) {
                return $candidate;
            }
            $i++;
        }
    }
}
