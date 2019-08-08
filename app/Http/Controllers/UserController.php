<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // views all users
        $this->authorize('viewAny', User::class);
        $users = User::allUsers();
        return response()->json([
            'message' => 'all users',
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        // creates new user
        $this->authorize('create', User::class);
        $user = User::newUser($request);
        return response()->json([
            'message' => 'New user created.',
            'user' => $user,
        ]);
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        return response()->json([
            'message' => 'Showing user',
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        User::editUser($request, $user);
        return response()->json([
            'message' => 'Updated user',
            'user' => $user,
        ]);
    }

    public function make_admin() {
        $admin_data = [];
        $admin_data['name'] = 'admin';
        $admin_data['email'] = 'admin@g.c';
        $admin_data['password'] = Hash::make('admin123');
        $admin_data['is_lead'] = false;
        $admin_data['is_admin'] = true;

        $admin = User::create($admin_data);

        $this->populate_table();

        return response()->json([
            'message' => 'Admin created.',
            'user' => $admin,
        ]);
    }

    public function populate_table() {
        $usernames = ['abc', 'abcd', 'abcde'];
        foreach ($usernames as $username) {
            $data = [];
            $data['name'] = $username;
            $data['email'] = $username.'@g.c';
            $data['password'] = Hash::make($username.'123');

            User::create($data);
        }

        for ($num=1; $num<=3; $num ++) {
            $data = [];
            $data['name'] = 'team'.$num;

            Team::create($data);
        }

        for ($num=1; $num<=3; $num ++) {
            $data = [];
            $data['name'] = 'project'.$num;
            $data['team_id'] = 2;

            Project::create($data);
        }
    }
}
