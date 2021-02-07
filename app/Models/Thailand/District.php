<?php

namespace App\Models\Thailand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function amphure()
    {
        return $this->belongsTo('App\Models\Thailand\Amphure');
    }
}
