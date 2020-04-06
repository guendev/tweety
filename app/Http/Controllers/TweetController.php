<?php

namespace App\Http\Controllers;

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
        $tweets =  Tweet::orderBy('created_at', 'DESC')
            ->take(5)
            ->get();
        $tweets_data = [];
        foreach ($tweets as $tweet){
            $tweets_data[] =[
                'id'            => $tweet->id,
                'content'       => $tweet->content,
                'tags'          => $tweet->tags,
                'count_like'    => $tweet->count_like,
                'count_comment' => $tweet->reply->count(),
                'count_share'   => $tweet->count_share,
                'author_id'     => $tweet->author->id,
                'author_name'   => $tweet->author->name,
                'author_avatar' => $tweet->author->avatar,
            ];
        }
        return view('layouts.home.index', compact('tweets_data'));
    }

    public function newsfeed(Request $request)
    {
            $input = $request->all();
            $limit = 5;
            $page = isset($input['page']) ? (int)$input['page'] : 1;

            $tweets =  Tweet::orderBy('created_at', 'DESC')
                ->skip( $limit*$page)
                ->take($limit)
                ->get();

            $tweets_data = [];
            foreach ($tweets as $tweet){
                $tweets_data[] =[
                    'id'            => $tweet->id,
                    'content'       => $tweet->content,
                    'tags'          => $tweet->tags,
                    'count_like'    => $tweet->count_like,
                    'count_comment' => $tweet->count_comment,
                    'count_share'   => $tweet->count_share,
                    'author_id'     => $tweet->author->id,
                    'author_name'   => $tweet->author->name,
                    'author_avatar' => $tweet->author->avatar,
                ];
            }

            return $this->responseSuccess('', $tweets_data);
    }


    public function tweet(){
        $attr = request()->validate([
            'content'   =>  'required'
        ]);
        Tweet::create([
            'user_id'   =>  current_user()->id,
            'content'   => $attr['content']
        ]);

        return [
            'user'  => current_user(),
            'post'  => current_user()->tweets()->latest("created_at")->first()
        ];
    }

}
