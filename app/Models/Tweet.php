<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    //
    public $table = 'tweets';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tags()
    {
        return $this->hasMany(TweetTag::class,'tweet_id');
    }

    public function reply()
    {
        return $this->hasMany(Reply::class,'tweet_id');
    }
    public function attr(){
        return $this->hasOne(Tweet_Attr::class,'tweet_id');
    }
}
