<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Plant extends Model
{
    use HasFactory, Notifiable, SoftDeletes, UseUuid;


    protected $fillable = [
        'code',
        'name',

    ];
}
