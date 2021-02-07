<?php

namespace App\Models\Settings;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingMasterProduct extends Model
{
    use HasFactory, SoftDeletes, UseUuid,UseLog;

    protected $appends = ['title'];

    protected $fillable = [
        'ref_id', 'name_th', 'name_en', 'type','retail_price','code',
    ];

    public function children()
    {
        return $this->hasMany('App\Models\Settings\SettingMasterProduct', 'ref_id', 'id')
            ->with('children')
            ->orderBy('created_at');
    }

    public function getTitleAttribute($value)
    {
        return "{$this->code} ({$this->name_en})";
    }
    public function product()
    {
        return $this->hasMany('App\Models\Product\Product');

    }
    public function settingMasterProductLog()
    {
        return $this->hasMany('App\Models\Log','ref_id','id');
    }
}
