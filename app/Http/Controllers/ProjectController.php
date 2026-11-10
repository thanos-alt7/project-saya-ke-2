<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index', [
            'projects' => Project::with('category')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('projects.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        Project::create($validated);

        return redirect()->route('post.projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', [
            'project' => $project,
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        $project->update($validated);

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
