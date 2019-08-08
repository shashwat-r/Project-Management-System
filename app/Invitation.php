<?php

namespace App;

use App\Mail\InviteeMail;
use App\Mail\InviterMail;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Invitation extends Model
{
    protected $fillable = ['user_id', 'project_id', 'lead_id', 'pending', 'accepted'];

    public static function newInvitation(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'lead_id' => 'required',
            'project_id' => 'required',
        ]);

        $all_request_fields = $request->all();

        $lead_team_id = DB::table('teams')->where('lead_id', $all_request_fields['lead_id'])->get('id')[0]->id;
        $project_team_id = DB::table('projects')->where('id', $all_request_fields['project_id'])->get('team_id')[0]->team_id;
        $user_team_id = DB::table('users')->where('id', $all_request_fields['user_id'])->get(['team_id'])[0]->team_id;

        if ($lead_team_id != $project_team_id) {
            // dd ('Lead unauthorised to assign project');
        }

        $request_fields = [];
        $request_fields['user_id'] = $all_request_fields['user_id'];
        $request_fields['project_id'] = $all_request_fields['project_id'];

//        dd(get_class($lead_team_id), $project_team_id, $user_team_id);
//        dd($lead_team_id, $project_team_id, $user_team_id);

        if ($lead_team_id == $user_team_id) {
            $project_user = ProjectUser::create($request_fields);
            return $project_user;
        } else {
            $request_fields['lead_id'] = $all_request_fields['lead_id'];
            $invitation = Invitation::create($request_fields);

            $data = [];
            $data['sender'] = User::find($request_fields['lead_id']);
            $data['receiver'] = User::find($request_fields['user_id']);
            $data['project'] = Project::find($request_fields['project_id']);

            Mail::to($data['receiver']->email)->send(new InviteeMail($data));
            Mail::to($data['sender']->email)->send(new InviterMail($data));

            return $invitation;
        }
    }

    public static function editInvitation(Request $request, Invitation $invitation) {
        $all_request_fields = $request->all();
        $request_fields = [];
        $request_fields['accepted'] = $all_request_fields['accepted'];
        $request_fields['pending'] = false;
        $invitation->update($request_fields);
        if ($request_fields['accepted']) {
            $request_fields = [];
            $request_fields['user_id'] = $invitation->user_id;
            $request_fields['project_id'] = $invitation->project_id;
            $project_user = ProjectUser::create($request_fields);
            return $project_user;
        }
        return null;
    }

    public static function listInvitations() {
        $login_id = Auth::id();
        $received_invitations = DB::table('invitations')->where('user_id', $login_id)->get();
        $sent_invitations = DB::table('invitations')->where('lead_id', $login_id)->get();
        $invitations = [];
        $invitations['received'] = $received_invitations;
        $invitations['sent'] = $sent_invitations;
        return $invitations;
    }
}
