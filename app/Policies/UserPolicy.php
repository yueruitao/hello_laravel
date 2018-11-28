<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //当前用户只能编辑自己的信息 查看Providers/AuthServiceProvider.php
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
    //当前用户必须是管理员才能删除用户,且删除的用户不是自己
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
