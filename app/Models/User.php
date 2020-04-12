<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Followable, TweetAction;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'story', 'avatar', 'sex', 'local', 'user_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function timeline()
    {
        return Tweet::orderBy('updated_at', 'DESC')
            ->take(5)
            ->get();
    }

    public function tweets(){
        return $this->hasMany(
            Tweet::class,
            'user_id'
        );
    }

    public function replies(){
        return $this->hasMany(
            Reply::class,
            'user_id'
        );
    }

    public function getRouteKeyName()
    {
        return 'user_name';
    }

    public function tweetattrs(){
        return $this->hasMany(
            Tweet_Attr::class,
            'user_id'
        );
    }

    public function getData(User $user_id)
    {
        return $user_id->user();
    }


    public function path($appent = '')
    {
        $path = route('User', $this->user_name);
        return $appent ? "{$path}/{$appent}" : $path;

    }

}
