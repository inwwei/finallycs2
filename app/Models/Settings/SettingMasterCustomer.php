<?php

namespace App\Models\Settings;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SettingMasterCustomer extends Model
{
    use HasFactory, SoftDeletes, UseUuid,UseLog;

    protected $appends = ['title'];

    protected $fillable = [
        'ref_id', 'name_th', 'name_en'
    ];
    public function children()
    {
        return $this->hasMany('App\Models\Settings\SettingMasterCustomer', 'ref_id', 'id')
            ->with('children')
            ->orderBy('created_at');
    }
    public function getTitleAttribute($value)
    {
        return "{$this->name_th} ({$this->name_en})";
    }
    public function settingMasterCustomerLog()
    {
        return $this->hasMany('App\Models\Log','ref_id','id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','id','setting_master_customer_id');
    }
}
