<?php

namespace App\Models\Thailand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function amphures()
    {
        return $this->hasMany('App\Models\Thailand\Amphure');
    }

    public function geographies()
    {
        return $this->belongsTo('App\Models\Thailand\Geography');
    }

    public function districts()
    {
        return $this->hasManyThrough('App\Models\Thailand\District', 'App\Models\Thailand\Amphure');
    }
}
