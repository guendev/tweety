<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function action(User $user)
    {
        auth()
            ->user()
            ->followAction($user);
        return back();
    }
}
