<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function prices()
    {
        return $this->hasMany(PackagePrice::class);
    }

    public function coupons()
    {
        return $this->hasMany(PackageCoupon::class);
    }

    public function features()
    {
        return $this->hasMany(PackageFeature::class);
    }
}
