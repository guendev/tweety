<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

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
        } catch (\Exception $exception){
            return $this->responseError('Tweet Failed');
        }
    }

    public function discovery()
    {
        return view('layouts.discovery.index');
    }

    /**
     * @param int $limit
     * @param int $page
     * @return mixed
     */
    public function getDataNewsFeed(int $limit, int $page)
    {
        return Tweet::orderBy('created_at', 'DESC')
            ->skip($limit * $page)
            ->take($limit)
            ->get();
    }

}
