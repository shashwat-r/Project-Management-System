<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
{
    public function index()
    {
//        $this->authorize('viewAny', Team::class);
        $teams = Team::allTeams();
        return response()->json([
            'message' => 'all teams',
            'teams' => $teams,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Team::class);
        $team = Team::newTeam($request);
        return response()->json([
            'message' => 'New team created.',
            'team' => $team,
        ]);
    }

    public function show(Team $team)
    {
        // also show team members
//        $this->authorize('view', $team);

        $members = $team->members();

        return response()->json([
            'message' => 'Showing team',
            'team' => $team,
            'members' => $members,
        ]);
    }

    public function update(Request $request, Team $team)
    {
        $this->authorize('update', $team);
        Team::editTeam($request, $team);
        return response()->json([
            'message' => 'Updated team',
            'team' => $team,
        ]);
    }
}