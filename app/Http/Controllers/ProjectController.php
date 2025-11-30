<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'members' => 'nullable|array',
            'members.*' => 'integer|exists:users,id',
        ]);

        $project = Project::create([
            'user_id' => Auth::id(),
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'] ?? null,
            'completed_projects' => null,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
        ]);

        $members = $data['members'] ?? [];

        $members[] = $project->user_id;

        $members = array_filter(array_unique($members), function ($id) {
            return !empty($id);
        });

        if (!empty($members)) {
            $project->members()->attach($members);
        }

        return redirect()->route('dashboard');
    }
    
    public function edit(Request $request, Project $project)
    {
        $user = Auth::user();
        
        $users = [];
        if ($project->isOwner($user)) {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'completed_projects' => 'nullable|string|max:255',
                'members' => 'nullable|array',
                'members.*' => 'integer|exists:users,id',
            ]);
        
            $project->update([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'price' => $data['price'] ?? null,
                'start_date' => $data['start_date'] ?? null,
                'end_date' => $data['end_date'] ?? null,
                'completed_projects' => $data['completed_projects'] ?? $project->completed_projects,
            ]);
        
            $members = $data['members'] ?? [];
            $members[] = $project->user_id;
            $members = array_filter(array_unique($members), function ($id) {
                return !empty($id);
            });
        
            $project->members()->sync($members);
        
            return redirect()->route('dashboard')->with('success', 'Project updated.');
        }
        
        if ($project->isMember($user)) {
            $data = $request->validate([
                'completed_projects' => 'nullable|string|max:255',
            ]);
        
            $project->completed_projects = $data['completed_projects'];
            $project->save();
        
            return redirect()->route('dashboard')->with('success', 'Progress updated.');
        }
        
    }
    public function update(Request $request, Project $project)
    {
        $users = User::all();
        return view('projects.edit', compact('project', 'users'));
    }
}
