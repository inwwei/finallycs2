<?php

namespace App\Models;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attached extends Model
{
    use  SoftDeletes, UseUuid,UseLog;

    protected $fillable = [
        'attachedable_type',
        'attachedable_id',
        'name',
        'path',
        'full_path',
        'mime_type',
        'type',
        'width',
        'height',
        'src',
        'alt',
        'description',
    ];

    public function attachedable()
    {
        return $this->morphTo('attachedable');
    }
    public function attachedLog()
    {
        return $this->hasMany('App\Models\Log','ref_id','id');
    }
}
