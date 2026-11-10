<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectGalleryController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        foreach ($request->file('images') as $index => $image) {
            $path = $image->store('projects/gallery', 'public');

            $project->images()->create([
                'image' => $path,
                'sort_order' => $index,
            ]);
        }

        return back()->with('success', 'Gallery berhasil ditambahkan.');
    }

    public function destroy(Project $project, ProjectImage $image)
    {
        abort_unless($image->project_id === $project->id, 404);

        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Gambar gallery berhasil dihapus.');
    }
}
