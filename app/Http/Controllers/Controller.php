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
            $tweets_data = $this->getAttr($tweet, $tweets_data);
        }
        return $tweets_data;
    }
    public function getCurrentUser()
    {
        return current_user();
    }

    /**
     * @param $tweet
     * @param array $tweets_data
     * @return array
     */
    public function getAttr($tweet, array $tweets_data): array
    {
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
            'tags' => $tweet_tag,
            'is_like' => current_user() ? current_user()->checkLike($tweet->id) : false,
            'count_like' => $tweet->count_like,
            'count_comment' => $tweet->reply()->count(),
            'count_share' => $tweet->count_share,
            'author_id' => $tweet->author->id,
            'author_user_name' => $tweet->author->user_name,
            'author_name' => $tweet->author->name,
            'author_avatar' => $tweet->author->avatar,
            'repling' => false
        ];
        return $tweets_data;
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
                'id'    => $user->id,
                'name' => $user->name,
                'avatar' => $user->avatar,
                'user_name' => $user->user_name
            ];
        }
        return $users_data;
    }
}
