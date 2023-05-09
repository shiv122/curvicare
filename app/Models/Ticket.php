<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function question()
    {
        return  $this->belongsTo(TicketQuestion::class, 'ticket_question_id');
    }

    public function  user()
    {
        return $this->belongsTo(User::class);
    }
}
