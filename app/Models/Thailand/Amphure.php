<?php

namespace App\Models\Thailand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amphure extends Model
{
    public function districts()
    {
        return $this->hasMany('App\Models\Thailand\District');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Thailand\Province');
    }
}
