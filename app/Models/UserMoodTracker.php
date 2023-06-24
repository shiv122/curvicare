<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMoodTracker extends Model
{
    use HasFactory;

    public $guarded = [];


    public function mood()
    {
        return $this->belongsTo(Mood::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
