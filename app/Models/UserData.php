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

    public function userGoal()
    {
        return $this->belongsTo(UserGoal::class);
    }

    public function userActivity()
    {
        return $this->belongsTo(UserActivity::class);
    }
}
