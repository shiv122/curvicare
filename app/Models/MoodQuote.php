<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodQuote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mood()
    {
        return $this->belongsTo(Mood::class);
    }
}
