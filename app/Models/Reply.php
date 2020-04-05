<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    public $table = 'replies';
    protected $primaryKey = 'id';

    public function tweet(){
        return $this->belongsTo(Tweet::class,'tweet_id' );
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function parent(){
        return $this->belongsTo(Reply::class,'parent_id');
    }
}
