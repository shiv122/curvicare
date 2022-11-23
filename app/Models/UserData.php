<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;

    protected $guarded = [];


    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    |
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_goal()
    {
        return $this->belongsTo(UserGoal::class);
    }

    public function user_activity()
    {
        return $this->belongsTo(UserActivity::class);
    }
}
