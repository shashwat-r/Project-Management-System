<?php

namespace App\Http\Controllers;

use App\Invitation;
use App\Project;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index() {
        // show all invitations for current user
        // if user is lead, also show sent invitations
        $invitations = Invitation::listInvitations();
        return response()->json([
            'message' => 'All invitations',
            'received' => $invitations['received'],
            'sent' => $invitations['sent'],
        ]);
    }

    public function store(Request $request)
    {
        $invitation = Invitation::newInvitation($request);
        return response()->json([
            'message' => 'New invitation created.',
            'invitation' => $invitation,
        ]);
    }

    public function update(Request $request, Invitation $invitation) {
        $project_users = Invitation::editInvitation($request, $invitation);
        return response()->json([
            'message' => 'Invitation edited.',
            'invitation' => $invitation,
            'project_users' => $project_users,
        ]);
    }
}
