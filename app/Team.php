<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Team extends Model
{
    protected $fillable = [
        'name', 'lead_id',
    ];

    public function members() {
        // don't know why it isn't working
        $members = DB::table('users')->where('team_id', $this->id)->get();
        return $members;
//        return $this->hasMany(User::class, 'team_id');
    }

    public static function allTeams() {
        $teams = Team::all();
        return $teams;
    }

    public static function newTeam(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);
        $all_request_fields = $request->all();
        $request_fields = [];
        $request_fields['name'] = $all_request_fields['name'];
        if (isset($all_request_fields['lead_id'])) {
            $request_fields['lead_id'] = $all_request_fields['lead_id'];
        }
        $team = Team::create($request_fields);
        return $team;
    }

    public static function editTeam(Request $request, Team $team) {
        $all_request_fields = $request->all();
        $request_fields = [];
        if (isset($all_request_fields['name'])) {
            $request_fields['name'] = $all_request_fields['name'];
        }
        if (isset($all_request_fields['lead_id'])) {
            $request_fields['lead_id'] = $all_request_fields['lead_id'];
        }
        $team->update($request_fields);
    }
}
