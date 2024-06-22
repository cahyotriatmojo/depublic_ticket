<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    //protected $fillable = ['package_id','total', 'date', 'total_price', 'status', 'snap_token', 'user_id', 'order_id'];

    public function packages()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
