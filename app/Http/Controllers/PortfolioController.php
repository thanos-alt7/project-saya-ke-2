<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function projects(Request $request)
    {
        $query = Project::with(['category', 'skills', 'images'])
            ->where('status', 'published')

            // Search
            ->when($request->search, function ($q, $search) {
                $q->where(function ($w) use ($search) {
                    $w->where('name', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })

            // Filter kategori
            ->when($request->category, function ($q, $category) {
                $q->whereHas('category', function ($w) use ($category) {
                    $w->where('slug', $category);
                });
            })

            // Filter skill
            ->when($request->skill, function ($q, $skill) {
                $q->whereHas('skills', function ($w) use ($skill) {
                    $w->where('skills.slug', $skill);
                });
            });

        // Sorting
        switch ($request->query('sort')) {
            case 'terlama':
                $query->oldest();
                break;

            case 'az':
                $query->orderBy('name');
                break;

            case 'tanggal':
                $query->orderByDesc('project_date');
                break;

            default:
                $query->latest();
                break;
        }

        $projects = $query->paginate(9)->withQueryString();

        $categories = Category::orderBy('name')->get();
        $skills = Skill::orderBy('name')->get();

        return view('projects', compact(
            'projects',
            'categories',
            'skills'
        ));
    }

    public function show(Project $project)
    {
        $project->load(['category', 'images', 'skills']);

        return view('portofolio.project', compact('project'));
    }
}
