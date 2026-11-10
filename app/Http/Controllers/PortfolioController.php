<?php

namespace App\Http\Controllers;

use App\Models\Project;

class PortfolioController extends Controller
{
    public function projects()
    {
        return view('projects', [
            'projects' => Project::latest()->get(),
        ]);
    }

    public function show(Project $project)
    {
        $project->load(['category', 'images']);

        return view('portofolio.project', compact('project'));
    }
}
