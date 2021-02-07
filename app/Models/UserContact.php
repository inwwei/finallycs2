<?php

namespace App\Models;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserContact extends Model
{
    use HasFactory, Notifiable, SoftDeletes, UseUuid,UseLog;

    protected $fillable = [
        'user_id',
        'setting_master_contact_id',
        'value',
        'house_number',
        'district',
        'amphure',
        'province',
        'postal_code',
    ];

    public function userContactLog()
    {
        return $this->hasMany('App\Models\Log','ref_id','id');
    }

    public function settingMasterContact()
    {
        return $this->belongsTo('App\Models\Settings\SettingMasterContact','setting_master_contact_id');
    }
}
