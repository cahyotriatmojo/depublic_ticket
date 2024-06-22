<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    public function packages(){
        return $this->hasMany(Package::class, 'event_id');
    }

    public function highlights(){
        return $this->hasMany(Highlight::class, 'event_id');
    }
    
    // Method untuk mendapatkan harga termurah dari paket-paket
    public function getCheapestPackagePrice()
    {
        return $this->packages()->min('price');
    }

    // Accessor for truncatedDescription
    public function getTruncatedDescriptionAttribute()
    {
        return \App\Helpers\TextHelper::truncate($this->description, 50);
    }

    // Accessor for hasQuota
    public function getHasQuotaAttribute()
    {
        return $this->packages->some(function ($package) {
            return $package->quota > 0;
        });
    }
}
