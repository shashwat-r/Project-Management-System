<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    protected $fillable = ['name', 'team_id'];

    public function members() {
        $members = DB::table('users')
            ->join('project_users', 'users.id', '=', 'project_users.user_id')
            ->select('users.*')
            ->get();
        return $members;
    }

    public static function allProjects() {
        $projects = DB::table('project_users')->where('user_id', Auth::id())->get();
        return $projects;
    }

    public static function newProject(Request $request) {
        $request->validate([
            'name' => 'required',
            'team_id' => 'required',
        ]);
        $all_request_fields = $request->all();
        $request_fields = [];
        $request_fields['name'] = $all_request_fields['name'];
        $request_fields['team_id'] = $all_request_fields['team_id'];
        $project = Project::create($request_fields);
        return $project;
    }
}
