<?php

namespace App\Models\Thailand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geography extends Model
{
    public function provinces()
    {
        return $this->hasMany('App\Models\Thailand\Province');
    }
}
