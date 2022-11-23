<?php

namespace App\Models;

use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'device_id',
        'username',
        'firebase_uid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    |
    */

    public function user_data()
    {
        return $this->hasOne(UserData::class);
    }


    public function moods()
    {
        return $this->hasMany(UserMoodTracker::class, 'user_id');
    }


    public function water()
    {
        return $this->hasMany(UserWaterTracker::class, 'user_id');
    }


    public function steps()
    {
        return $this->hasMany(UserStepCounter::class, 'user_id');
    }

    public function medical_conditions()
    {
        return $this->hasMany(UserMedicalCondition::class);
    }



    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    |
    */


    public function scopeNotAdmin($query)
    {
        return $query->where('isAdmin', '0');
    }
}
