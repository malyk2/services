<?php

namespace App\Policies\Admin;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {

    }

    public function manage(User $user)
    {
        return $user->hasPerm('users.manage');
    }

    public function edit(User $authUser, User $editUser)
    {
        return $this->manage($authUser) && $editUser->canEdit() && $editUser->belogsUser($authUser);
    }

    public function delete(User $authUser, User $editUser)
    {
        return $this->manage($authUser) && $editUser->canDelete() && $editUser->belogsUser($authUser);
    }
}
