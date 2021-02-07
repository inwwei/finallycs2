<?php

namespace App\Models\Settings;

use App\Traits\UseLog;
use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingBasicBranch extends Model
{
    use HasFactory, SoftDeletes, UseUuid,UseLog;

    protected $appends = ['title'];

    protected $fillable = [
        'branch_name',
        'branch_code',
        'company_id'
    ];

    public function product()
    {
        return $this->hasMany('App\Models\Product\Product');
    }

    public function getTitleAttribute()
    {
        return "{$this->branch_name}({$this->branch_code})";
    }

    public function settingBasicCompany () {
        return $this->belongsTo('App\Models\Settings\SettingBasicCompany','company_id');
    }

}
