<?php

namespace App\Models;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UseUuid, SoftDeletes,UseLog;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'identification_number',
        'financial',
        'username',
        'password',
        'code',
        'setting_master_users_id',
        'branch_id',
        'email',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userLog()
    {
        return $this->hasMany('App\Models\Log','ref_id','id');
    }
    public function attacheds()
    {
        return $this->morphMany('App\Models\Attached', 'attachedable');
    }

    public function userContacts()
    {
        return $this->hasMany('App\Models\UserContact','user_id','id');
    }

    public function settingMasterUser()
    {
        return $this->belongsTo('App\Models\Settings\SettingMasterUser','setting_master_users_id');
    }

    public function settingBasicBranch()
    {
        return $this->belongsTo('App\Models\Settings\SettingBasicBranch','branch_id','id');
    }
}
