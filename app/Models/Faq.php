<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function faq_category()
    {
        return $this->belongsTo(FaqCategory::class);
    }








    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }


    public function scopeIsPaid($q)
    {
        return $q->where('is_paid', 'yes');
    }


    public function scopeIsFeatured($q)
    {
        return $q->where('is_featured', 'yes');
    }
}
