<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()
            ->withCount('images')
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
        $validated = $this->validateProject($request);
        $data = $this->prepareProjectData($request, $validated);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/projects', 'public');
        }

        $project = Project::create($data);
        $this->storeGalleryImages($request, $project);

        return redirect()->route('admin.projects.index')->with('status', 'Portfolio item created.');
    }

    public function edit(Project $project)
    {
        $project->load('images');

        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $this->validateProject($request, $project);
        $data = $this->prepareProjectData($request, $validated, $project);
        $oldImage = $project->image;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/projects', 'public');
        }

        $project->update($data);

        if ($request->hasFile('image') && $oldImage && $oldImage !== $project->image) {
            $this->deleteImageIfUnused($oldImage);
        }

        $this->syncExistingGalleryImages($request, $project);
        $this->storeGalleryImages($request, $project);

        return redirect()->route('admin.projects.index')->with('status', 'Portfolio item updated.');
    }

    public function destroy(Project $project)
    {
        $pathsToCheck = collect([$project->image])
            ->merge($project->images()->pluck('image_path'))
            ->filter()
            ->unique()
            ->values();

        $project->delete();

        foreach ($pathsToCheck as $path) {
            $this->deleteImageIfUnused($path);
        }

        return redirect()->route('admin.projects.index')->with('status', 'Portfolio item deleted.');
    }

    /**
     * Validate project fields and optional multi-angle gallery inputs.
     */
    private function validateProject(Request $request, ?Project $project = null): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:projects,slug'.($project ? ','.$project->id : '')],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'max:4096'],
            'gallery_captions' => ['nullable', 'array'],
            'gallery_captions.*' => ['nullable', 'string', 'max:255'],
            'project_url' => ['nullable', 'string', 'max:2048'],
            'category' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
        ];

        if ($project !== null) {
            $rules['existing_captions'] = ['nullable', 'array'];
            $rules['existing_captions.*'] = ['nullable', 'string', 'max:255'];
            $rules['existing_sort_orders'] = ['nullable', 'array'];
            $rules['existing_sort_orders.*'] = ['nullable', 'integer', 'min:0'];
            $rules['delete_gallery_images'] = ['nullable', 'array'];
            $rules['delete_gallery_images.*'] = ['integer'];
        }

        return $request->validate($rules);
    }

    /**
     * Normalize scalar project attributes before persistence.
     */
    private function prepareProjectData(Request $request, array $validated, ?Project $project = null): array
    {
        $data = Arr::except($validated, [
            'image',
            'gallery_images',
            'gallery_captions',
            'existing_captions',
            'existing_sort_orders',
            'delete_gallery_images',
        ]);

        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);
        $data['slug'] = $this->generateUniqueSlug(
            ($data['slug'] ?? '') !== '' ? $data['slug'] : Str::slug($data['title']),
            $project?->id
        );

        return $data;
    }

    /**
     * Persist newly uploaded angle images for the project.
     */
    private function storeGalleryImages(Request $request, Project $project): void
    {
        if (! $request->hasFile('gallery_images')) {
            return;
        }

        $maxOrder = $project->images()->max('sort_order');
        $nextOrder = $maxOrder === null ? 0 : ((int) $maxOrder) + 1;
        $captions = $request->input('gallery_captions', []);

        foreach ($request->file('gallery_images') as $index => $file) {
            $path = $file->store('uploads/projects', 'public');
            $caption = isset($captions[$index]) ? trim((string) $captions[$index]) : null;

            $project->images()->create([
                'image_path' => $path,
                'caption' => $caption !== '' ? $caption : null,
                'sort_order' => $nextOrder++,
            ]);
        }
    }

    /**
     * Update captions/order or delete marked existing gallery images.
     */
    private function syncExistingGalleryImages(Request $request, Project $project): void
    {
        $deleteIds = array_map('intval', $request->input('delete_gallery_images', []));
        $captions = $request->input('existing_captions', []);
        $sortOrders = $request->input('existing_sort_orders', []);

        foreach ($project->images()->get() as $galleryImage) {
            if (in_array($galleryImage->id, $deleteIds, true)) {
                $path = $galleryImage->image_path;
                $galleryImage->delete();
                $this->deleteImageIfUnused($path);

                continue;
            }

            $updates = [];
            if (array_key_exists($galleryImage->id, $captions)) {
                $caption = trim((string) $captions[$galleryImage->id]);
                $updates['caption'] = $caption !== '' ? $caption : null;
            }
            if (
                array_key_exists($galleryImage->id, $sortOrders)
                && $sortOrders[$galleryImage->id] !== null
                && $sortOrders[$galleryImage->id] !== ''
            ) {
                $updates['sort_order'] = max(0, (int) $sortOrders[$galleryImage->id]);
            }

            if ($updates !== []) {
                $galleryImage->update($updates);
            }
        }
    }

    /**
     * Remove a stored public image file only when no project or angle still references it.
     */
    private function deleteImageIfUnused(?string $path): void
    {
        if (! $path || str_starts_with($path, 'http') || str_starts_with($path, '/')) {
            return;
        }

        $stillUsed = Project::query()->where('image', $path)->exists()
            || ProjectImage::query()->where('image_path', $path)->exists();

        if (! $stillUsed) {
            Storage::disk('public')->delete($path);
        }
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
