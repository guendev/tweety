<?php


namespace App\Models;
use App\Models\LikeTweet;

trait TweetAction
{
    public function likeAction($tweet)
    {
        if ($this->checkLike($tweet)){
            $this->like()->detach($tweet);
            return $this->counterlike($tweet);
        } else {
            LikeTweet::create([
                'user_id'   => auth()->id(),
                'tweet_id'  => $tweet
            ]);
            return $this->counterlike($tweet);
        }
    }

    public function counterlike($tweet){
        $couter = Tweet::findOrFail($tweet);
        if ($this->checkLike($tweet)){
            return $couter->update([
                'count_like'    => $couter->count_like + 1
            ]);
        } else {
            return $couter->update([
                'count_like'    => $couter->count_like - 1
            ]);
        }
    }
    public function checkLike($tweet)
    {
        return LikeTweet::where([
            ["user_id", "=", auth()->id()],
            ["tweet_id", "=", $tweet]]
        )->exists();
    }

    public function like()
    {
        return $this->belongsToMany(
            Tweet::class,
            'like_tweets',
            'user_id',
            'tweet_id'
        );
    }
}
