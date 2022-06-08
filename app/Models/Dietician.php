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




    //scopes
    public function scopeActive($query, $status = 'active')
    {
        return $query->where('status', $status);
    }
}
