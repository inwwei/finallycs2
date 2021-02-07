<?php

namespace App\Models\Settings;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingDevice extends Model
{
    use HasFactory, SoftDeletes, UseUuid, UseLog;

    protected $fillable = [
        'id', 'name', 'pin', 'use_at',
    ];
    public function settingDeviceLog()
    {
        return $this->hasMany('App\Models\Log', 'ref_id', 'id');
    }
}
