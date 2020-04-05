<?php


namespace App\Http\Controllers;

use App\Models\User;
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
}
