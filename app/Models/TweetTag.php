<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TweetTag extends Model
{
    public $table = 'tweet_tags';
    protected $primaryKey = 'id';

    public function tweet(){
        return $this->belongsTo(Tweet::class);
    }

    public function tag(){
        return $this->belongsTo(Tag::class,'tag_id');
    }

}
