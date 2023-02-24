<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDailyDiet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dietician()
    {
        return $this->belongsTo(Dietician::class);
    }



    public function scopeUncompleted()
    {
        return $this
            ->whereDate('date', today())
            ->where('is_completed', false);
    }

    public function scopeCompleted()
    {
        return $this->where('is_completed', true);
    }

    public function scopeForUpcomingDays($query, int $days)
    {
        return $query->whereDate('schedule_date', '>=', today())
            ->whereDate('schedule_date', '<=', today()->addDays($days)->toDateString());
    }
}
