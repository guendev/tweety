<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet_Attr extends Model
{
    public $table = 'tweet_attrs';
    protected $primaryKey = 'id';

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function tweet(){
        return $this->belongsTo(Tweet::class,'tweet_id');
    }

    public function reply(){
        return $this->belongsTo(Reply::class,'reply_id');
    }
}
