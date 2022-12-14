<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;


trait Likable
{
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }


    public function isLikedBy(Model $liker)
    {
        return $this->likes()->where('liker_id', $liker->id)->exists();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}
