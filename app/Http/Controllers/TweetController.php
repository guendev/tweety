<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class TweetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $tweets = $this->getdataNewsFeed(5, 0);
        $tweets_data = $this->getNewsFeed($tweets);
        return view('layouts.home.index', compact('tweets_data'));
    }


    public function infinity(Request $request)
    {
            $input = $request->all();
            $limit = 5;
            $page = isset($input['page']) ? (int)$input['page'] : 1;
            $tweets = $this->getDataNewsFeed($limit, $page);
            return $this->getNewsFeed($tweets);
    }


    public function tweet(){
        try {
            $attr = request()->validate([
                'content'   =>  'required'
            ]);
            Tweet::create([
                'user_id'   =>  current_user()->id,
                'content'   => $attr['content']
            ]);
            $tweet = current_user()->tweets()->latest("created_at")->first();
            $tweets_data = [];
            return $this->responseSuccess('Tweet Success', $this->getAttr($tweet, $tweets_data));
        } catch (Exception $exception){
            return $this->responseError('Tweet Failed');
        }
    }

    public function discovery()
    {
        return view('layouts.discovery.index');
    }

    public function search(Request $request){
        try {
            $value = $request['input'];
            $users = User::where('user_name', 'like', '%'.$value.'%')->take(5)->get();
            $users_data = [];
            $users_data = $this->getUserAttr($users, $users_data);
            $tweets = Tweet::where('content', 'like' , '%'.$value.'%')->take(2)->get();
            $tweets_data = $this->getNewsFeed($tweets);
            return $this->responseSuccess('', [
                'user' => $users_data,
                'tweets' => $tweets_data
            ]);
        } catch (Exception $exception){
            return $this->responseError('Error, please try again!');
        }
    }

    /**
     * @param int $limit
     * @param int $page
     * @return mixed
     */
    public function getDataNewsFeed(int $limit, int $page)
    {
        return Tweet::whereIn('user_id', current_user()->following->pluck('id')->toArray())->orderBy('created_at', 'DESC')
            ->skip($limit * $page)
            ->take($limit)
            ->get();
    }

    /**
     * @param $users
     * @param array $users_data
     * @return array
     */
    public function getUserAttr($users, array $users_data): array
    {
        foreach ($users as $user) {
            $users_data[] = [
                'name' => $user->name,
                'avatar' => $user->avatar,
                'user_name' => $user->user_name
            ];
        }
        return $users_data;
    }

}
