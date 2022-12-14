<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dietician extends Authenticatable

{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes;

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



    //scopes
    public function scopeActive($query, $status = 'active')
    {
        return $query->where('status', $status);
    }
}
