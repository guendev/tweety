<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $table = 'tags';
    protected $primaryKey = 'id';

    public function tweet()
    {
        return $this->hasMany(TweetTag::class,'id');
    }
}
