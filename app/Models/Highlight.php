<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];

    public function events(){
        return $this->belongsTo(Event::class, 'event_id');
    }
}
