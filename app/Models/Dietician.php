<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dietician extends Authenticatable

{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes, HasRelationships;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function bank()
    {
        return $this->hasOne(DieticianBankDetails::class,);
    }


    public function direct_expertise()
    {
        return $this->hasManyThrough(Expertise::class, DieticianExpertise::class, 'dietician_id', 'id', 'id', 'expertise_id');
    }

    public function expertise()
    {
        return $this->hasMany(DieticianExpertise::class, 'dietician_id', 'id');
    }


    public function assignments()
    {
        return $this->hasMany(AssignedDietician::class, 'dietician_id', 'id');
    }


    public function assigned_daily_diets()
    {
        return $this->hasMany(UserDailyDiet::class, 'dietician_id', 'id');
    }


    public function chats()
    {
        return $this->hasManyThrough(
            Chat::class,
            AssignedDietician::class
        );
    }


    public function messages()
    {
        return $this->hasManyDeep(
            Message::class,
            [AssignedDietician::class, Chat::class],
        );
    }



    public function calls()
    {
        return $this->hasMany(Call::class);
    }



    //scopes
    public function scopeActive($query, $status = 'active')
    {
        return $query->where('status', $status);
    }
}
