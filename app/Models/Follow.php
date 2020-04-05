<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Follow extends Pivot
{
    public function following()
    {
        return $this->belongsTo(User::class,'user_follow_id');
    }
}
