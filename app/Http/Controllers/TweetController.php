<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;

class TweetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users = User::inRandomOrder()->limit(4)->get();
        return view('layouts.home.index', [
            'tweets'    => auth()->user()->timeline()
        ]);
    }


    public function tweet(){
        $attr = request()->validate([
            'content'   =>  'required'
        ]);
        Tweet::create([
            'user_id'   =>  auth()->id(),
            'content'   => $attr['content']
        ]);

        return back();
    }
}
