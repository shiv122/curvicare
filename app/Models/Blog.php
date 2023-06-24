<?php

namespace App\Models;

use App\Traits\Likable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory, Likable;

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }


    public function image()
    {
        return $this->hasOne(BlogImage::class);
    }

    public function tags()
    {
        return $this->hasMany(BlogTag::class)->with(['tag:id,name']);
    }


    public function direct_tags()
    {
        return $this->hasManyThrough(Tag::class, BlogTag::class, 'blog_id', 'id', 'id', 'tag_id');
    }

    public function dietician()
    {
        return $this->belongsTo(Dietician::class)->select('id', 'name', 'image');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function liked()
    {
        return $this->morphOne(Like::class, 'likeable');
    }
}
