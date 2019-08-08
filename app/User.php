<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'team_id', 'is_lead', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function team() {
        return $this->hasOne(Team::class);
    }

    public static function allUsers() {
        return User::all();
    }

    public static function newUser(Request $request) {
//        dd('hi');
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $all_request_fields = $request->all();
        $request_fields = [];
        $request_fields['name'] = $all_request_fields['name'];
        $request_fields['email'] = $all_request_fields['email'];
        $request_fields['password'] = Hash::make($all_request_fields['password']);
        $user = User::create($request_fields);
        return $user;
    }

    public static function editUser(Request $request, User $user) {
        $all_request_fields = $request->all();
        $request_fields = [];
        if (isset($all_request_fields['team_id'])) {
            $request_fields['team_id'] = $all_request_fields['team_id'];
        }
        if (isset($all_request_fields['is_lead'])) {
            $request_fields['is_lead'] = $all_request_fields['is_lead'];
        }
        if (isset($all_request_fields['is_admin'])) {
            $request_fields['is_admin'] = $all_request_fields['is_admin'];
        }
        $user->update($request_fields);
    }
}
