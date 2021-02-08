<?php

namespace App\Models;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charts extends Model
{
    use HasFactory, Notifiable, SoftDeletes, UseUuid;


    protected $fillable = [
        'code',
        'name',
        'date',
        'max_price',
        'min_price',
    ];
}
