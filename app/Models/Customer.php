<?php

namespace App\Models;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, Notifiable, SoftDeletes, UseUuid, UseLog;


    protected $fillable = [
        'code',
        'setting_master_customer_id',
        'customer_name',
        'identification_number',
        'setting_basic_branch_id',
        'tax_id'
    ];

    public function customerContacts()
    {
        return $this->hasMany('App\Models\CustomerContact','customer_id','id');
    }
    public function settingMasterCustomer()
    {
        return $this->belongsTo('App\Models\Settings\SettingMasterCustomer','setting_master_customer_id');
    }
    public function settingBasicBranch()
    {
        return $this->belongsTo('App\Models\Settings\SettingBasicBranch','setting_basic_branch_id','id');
    }

    public function customerLog()
    {
        return $this->hasMany('App\Models\Log','ref_id','id');
    }

    public function contact()
    {
        return $this->hasMany('App\Models\CustomerContact')->where('type','Tel')->limit(1);
    }

    public function attacheds()
    {
        return $this->morphMany('App\Models\Attached', 'attachedable');
    }


}
