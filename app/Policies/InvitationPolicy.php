<?php

namespace App\Policies;

use App\User;
use App\Invitation;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any invitations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the invitation.
     *
     * @param  \App\User  $user
     * @param  \App\Invitation  $invitation
     * @return mixed
     */
    public function view(User $user, Invitation $invitation)
    {
        //
    }

    /**
     * Determine whether the user can create invitations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the invitation.
     *
     * @param  \App\User  $user
     * @param  \App\Invitation  $invitation
     * @return mixed
     */
    public function update(User $user, Invitation $invitation)
    {
        //
    }

    /**
     * Determine whether the user can delete the invitation.
     *
     * @param  \App\User  $user
     * @param  \App\Invitation  $invitation
     * @return mixed
     */
    public function delete(User $user, Invitation $invitation)
    {
        //
    }

    /**
     * Determine whether the user can restore the invitation.
     *
     * @param  \App\User  $user
     * @param  \App\Invitation  $invitation
     * @return mixed
     */
    public function restore(User $user, Invitation $invitation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the invitation.
     *
     * @param  \App\User  $user
     * @param  \App\Invitation  $invitation
     * @return mixed
     */
    public function forceDelete(User $user, Invitation $invitation)
    {
        //
    }
}
