<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedDietician extends Model
{
    use HasFactory;

    protected $guarded = [];




    public function dietician()
    {
        return $this->belongsTo(Dietician::class, 'dietician_id', 'id');
    }


    public function assignment()
    {
        return $this->belongsTo(DieticianAssignment::class, 'dietician_assignment_id', 'id');
    }


    public function chats()
    {
        return $this->hasManyThrough(
            Chat::class,
            DieticianAssignment::class,
            'id',
            'dietician_assignment_id',
            'dietician_assignment_id',
            'id'
        );
    }
}
