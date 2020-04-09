<?php


namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class RecommendController extends Controller
{
    public function getYourFriends(Request $request)
    {
        if (auth()->check()){
            return $this->responseSuccess('', auth()->user()->following->take(5));
        } else {
            return User::take(5);
        }
    }
}
