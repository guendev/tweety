<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    public $table = 'replies';
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'tweet_id', 'content'];

    public function tweet(){
        return $this->belongsTo(Tweet::class,'tweet_id' );
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function parent(){
        return $this->belongsTo(Reply::class,'parent_id');
    }

    public function createReply($id, $content)
    {
        Reply::create([
            'user_id'   =>  current_user()->id,
            'tweet_id'  =>  $id,
            'content'   =>  $content
        ]);
    }
}
