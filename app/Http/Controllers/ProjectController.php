<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Skill;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('category');

        // Search berdasarkan nama project
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan status
        if (in_array($request->status, ['draft', 'published'])) {
            $query->where('status', $request->status);
        }

        $projects = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create', [
            'categories' => Category::all(),
            'skills' => Skill::all(),
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|max:255|unique:projects,name',
            'category_id'       => 'required|exists:categories,id',
            'short_description' => 'nullable|max:255',
            'description'       => 'nullable',
            'status'            => 'required|in:draft,published',
            'project_url'       => 'nullable|url|max:255',
            'repository_url'    => 'nullable|url|max:255',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
            'skills'            => 'nullable|array',
            'skills.*'          => 'exists:skills,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $skillIds = $validated['skills'] ?? [];
        unset($validated['skills']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        $project = Project::create($validated);
        $project->skills()->sync($skillIds);

        return redirect()->route('post.projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }


    public function edit(Project $project)
    {
        return view('projects.edit', [
            'project' => $project,
            'categories' => Category::all(),
            'skills' => Skill::all(),
        ]);
    }


    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name'              => [
                'required',
                'max:255',
                Rule::unique('projects', 'name')->ignore($project->id),
            ],
            'category_id'       => 'required|exists:categories,id',
            'short_description' => 'nullable|max:255',
            'description'       => 'nullable',
            'status'            => 'required|in:draft,published',
            'project_url'       => 'nullable|url|max:255',
            'repository_url'    => 'nullable|url|max:255',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
            'skills'            => 'nullable|array',
            'skills.*'          => 'exists:skills,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $skillIds = $validated['skills'] ?? [];
        unset($validated['skills']);

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        $project->update($validated);
        $project->skills()->sync($skillIds);

        return redirect()->route('post.projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }


    public function destroy(Project $project)
    {
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        $project->delete();

        return redirect()->route('post.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}
