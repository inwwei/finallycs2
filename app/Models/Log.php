<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use HasFactory, SoftDeletes, UseUuid;

    protected $casts = [
        'before_data' => 'array',
        'after_data' => 'array',
    ];

    protected $fillable = [
        'ref_id',
        'table_name',
        'before_data',
        'after_data',
        'time',
    ];

}
