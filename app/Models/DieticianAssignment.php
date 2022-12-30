<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DieticianAssignment extends Model
{
    use HasFactory;


    protected $guarded = [];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }



    public function assigned_dieticians()
    {
        return $this->hasMany(AssignedDietician::class, 'dietician_assignment_id', 'id');
    }


    public function chat()
    {
        return $this->hasOne(Chat::class, 'dietician_assignment_id', 'id');
    }
}
