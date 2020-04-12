<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function responseSuccess($msg, $data = [])
    {
        return response()->json([
            'error' => false,
            'msg' => $msg,
            'data' => $data
        ]);
    }
    public function responseError($msg, $data = [])
    {
        return response()->json([
            'error' => true,
            'msg' => $msg,
            'data' => $data
        ]);
    }

    /**
     * @param $tweets
     * @return array
     */
    public function getNewsFeed( $tweets ): array
    {
        $tweets_data = [];
        foreach ($tweets as $tweet) {
            $tweet_tag = [];
            if (isset($tweet->tags)) {
                foreach ($tweet->tags as $tag) {
                    $tweet_tag[] = [
                        'tag' => $tag->tag->tag
                    ];
                }
            }
            $tweets_data[] = [
                'id' => $tweet->id,
                'content' => $tweet->content,
                'tags' => $tweet->tags,
                'is_like' => current_user() ? current_user()->checkLike($tweet->id) : false ,
                'count_like' => $tweet->count_like,
                'count_comment' => $tweet->count_comment,
                'count_share' => $tweet->count_share,
                'author_id' => $tweet->author->id,
                'author_user_name' => $tweet->author->user_name,
                'author_name' => $tweet->author->name,
                'author_avatar' => $tweet->author->avatar,
            ];
        }
        return $tweets_data;
    }
}
