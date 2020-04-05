<?php


namespace App\Models;


trait Followable
{

    public function sameFollow()
    {
        $query = Follow::where('user_id', auth()->id())
            ->whereIn("user_follow_id", $this
                ->following()
                ->pluck('user_follow_id'));

        return [
            'avatars' => $query->take(3)->get(),
            'count' => $query->count()
        ];
    }


    public function follow(User $user){
        return $this->following()->save($user);
    }

    public function unfollow(User $user){
        return $this->following()->detach($user);
    }

    public function followAction(User $user)
    {
        if($this->isFollowing($user)
        ){
           return $this->unfollow($user);
        }else{
           return $this->follow($user);
        }
    }

    public function follower()
    {
        return $this->belongsToMany(
            User::class,
            'follow',
            'user_follow_id',
            'user_id'
        );
    }

    public function isFollowing(User $user)
    {
        return $this->following()
            ->where('user_follow_id', $user->id)
            ->exists();
    }


    public function following()
    {
        return $this->belongsToMany(
            User::class,
            'follow',
            'user_id',
            'user_follow_id'
        );
    }

}
