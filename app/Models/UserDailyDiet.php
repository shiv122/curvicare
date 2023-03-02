<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function scopeForUpcomingDays($query, int $days, string $date = null)
    {
        return $query->whereDate('schedule_date', '>=', $date ?? today())
            ->whereDate('schedule_date', '<=', ($date) ? Carbon::parse($date)->addDays($days - 1) : today()->addDays($days - 1));
    }
}
