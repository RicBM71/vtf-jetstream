<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function delete(User $authUser, User $user)
    {

        

        if ($user->id === 1)
            return abort(403, '¿Estamos locos?, este usuario NO se puede borrar');

        return isRoot() ?: abort(403, __('User does not have the right permissions.'));

    }
}
