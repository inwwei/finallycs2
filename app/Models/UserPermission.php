<?php

namespace App\Models;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserPermission extends Model
{
    use HasApiTokens, HasFactory, Notifiable, UseUuid, SoftDeletes;

    protected $fillable = [
        'user_permission',
        'user_id',
    ];

    public function userPermissionLog()
    {
        return $this->hasMany('App\Models\Log','ref_id','id');
    }
}
