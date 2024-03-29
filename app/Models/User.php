<?php

namespace App\Models;

use App\Traits\Liker;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, Liker;

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
        'image',
        'status',
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
        return $this->hasOne(UserData::class)->latest();
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


    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }


    public function assignments()
    {
        return $this->hasMany(DieticianAssignment::class);
    }


    public function chats()
    {
        return $this->hasMany(Chat::class);
    }


    public function messages()
    {
        return $this->hasMany(Message::class);
    }


    public function daily_diet()
    {
        return $this->hasMany(UserDailyDiet::class);
    }


    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }


    public function support_chats()
    {
        return $this->hasMany(SupportChat::class);
    }


    public function calls()
    {
        return $this->hasMany(Call::class);
    }


    public function weekly_reports()
    {
        return $this->hasMany(WeeklyReport::class);
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

    public function scopeIsCurrentlySubscribed($q)
    {
        return $q->whereHas('assignments', function ($q) {
            $q->where('expiry', '>=', now())
                ->where('status', '!=', 'cancelled');
        })->exists();
    }
}
