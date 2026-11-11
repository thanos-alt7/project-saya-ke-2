<?php

namespace App\Http\Controllers;

use App\Models\{Category, Project, Skill, Technology};

class DashboardController extends Controller
{
    public function index()
    {
        return view('post.dashboard', [
            // Total project
            'totalProjects' => Project::count(),

            // Jumlah project berdasarkan status
            'totalPublished' => Project::where('status', 'published')->count(),
            'totalDraft' => Project::where('status', 'draft')->count(),

            // Total data lainnya
            'totalCategories' => Category::count(),
            'totalTechnologies' => Technology::count(),
            'totalSkills' => Skill::count(),

            // Lima project terbaru
            'latestProjects' => Project::with('category')
                ->latest()
                ->take(5)
                ->get(),

            // Lima skill dengan jumlah project terbanyak
            'topSkills' => Skill::withCount('projects')
                ->orderByDesc('projects_count')
                ->take(5)
                ->get(),

            // Jumlah project pada setiap kategori
            'categories' => Category::withCount('projects')->get(),
        ]);
    }
}
