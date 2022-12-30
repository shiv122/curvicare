<?php

namespace App\Models;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Znck\Eloquent\Traits\BelongsToThrough;

class Chat extends Model
{
    use HasFactory, BelongsToThrough;

    protected $guarded = [];



    public function assignment()
    {
        return $this->belongsTo(DieticianAssignment::class, 'dietician_assignment_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_id', 'id');
    }


    public function dietician()
    {
        return $this->belongsToThrough(
            Dietician::class,
            AssignedDietician::class,
        );
    }
}
