<?php


namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;

class ProfileController extends Controller
{
    public function index(User $user){
        return view('layouts.profile.index', compact('user'));
    }

    public function edit(User $user){
        try {
            $this->authorize('edit', $user);
        } catch (AuthorizationException $e) {
            return redirect(route('tweets'));
        }
        return view('layouts.profile.edit', compact('user'));
    }

    public function infinity(Request $request)
    {
        $input = $request->all();
        if (isset($input['user_id']) && $input['user_id'] > 0){
            $limit = 5;
            $page = isset($input['page']) ? (int)$input['page'] : 1;

            return Tweet::where('user_id', $input['user_id'])
                ->orderBy('created_at', 'DESC')
                ->skip($limit*$page)
                ->take($limit)
                ->get();
        }
        return false;
    }
}
