<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

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

    public function dietician()
    {
        return $this->belongsTo(Dietician::class)->select('id', 'name', 'image');
    }
}
