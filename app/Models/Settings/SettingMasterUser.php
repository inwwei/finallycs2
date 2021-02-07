<?php

namespace App\Models\Settings;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingMasterUser extends Model
{
    use HasFactory, SoftDeletes, UseUuid,UseLog;


    protected $appends = ['title'];

    protected $fillable = [
        'ref_id', 'name_th', 'name_en','default_financial','checkLogin',
    ];

    public function children()
    {
        return $this->hasMany('App\Models\Settings\SettingMasterUser', 'ref_id', 'id')
            ->with('children')
            ->orderBy('created_at');
    }

    public function getTitleAttribute($value)
    {
        return "{$this->name_th} ({$this->name_en})";
    }

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    public function settingMasterUserLog()
    {
        return $this->hasMany('App\Models\Log','ref_id','id');
    }
}
