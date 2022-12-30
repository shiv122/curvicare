<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function media()
    {
        return $this->hasMany(MessageMedia::class, 'message_id', 'id');
    }

    public function reply()
    {
        return $this->belongsTo(Message::class, 'reply_to', 'id');
    }

    public function dietician()
    {
        return $this->belongsTo(Dietician::class, 'dietician_id', 'id');
    }
}
