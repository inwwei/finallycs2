<?php

namespace App\Models\Settings;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingGenerateCode extends Model
{
    use HasFactory, SoftDeletes, UseUuid,UseLog;
    protected $fillable = [
        'setting_basic_branch_id','code', 'pattern','name'
    ];
    public function settingBasicBranch()
    {
        return $this->belongsTo('App\Models\Settings\SettingBasicBranch','setting_basic_branch_id','id');
    }
}
