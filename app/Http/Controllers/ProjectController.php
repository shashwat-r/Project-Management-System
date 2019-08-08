<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
//        $this->authorize('viewAny', Project::class);
        $projects = Project::allProjects();
        return response()->json([
            'message' => 'all projects',
            'projects' => $projects,
        ]);

    }

    public function store(Request $request)
    {
//        $this->authorize('create', Project::class);
        $project = Project::newProject($request);
        return response()->json([
            'message' => 'New project created.',
            'project' => $project,
        ]);
    }

    public function show(Project $project)
    {
//        $this->authorize('view', $project);
        $members = $project->members();
        return response()->json([
            'message' => 'Showing project',
            'project' => $project,
            'members' => $members,
        ]);
    }
}
