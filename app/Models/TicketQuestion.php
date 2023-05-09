<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }




    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }
}
