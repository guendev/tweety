<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller
{
    public function action(User $user)
    {
        auth()
            ->user()
            ->followAction($user);
        return [
            'isfollow' => current_user()->isFollowing($user)
        ];
    }
}
