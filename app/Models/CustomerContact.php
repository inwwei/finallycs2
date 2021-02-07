<?php

namespace App\Models;

use App\Traits\UseLog;
use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerContact extends Model
{
    use HasFactory, Notifiable, SoftDeletes, UseUuid,UseLog;

    protected $appends = ['title'];

    protected $fillable = [
        'customer_id',
        'setting_master_contact_id',
        'value',
        'house_number',
        'district',
        'amphure',
        'province',
        'postal_code',
        'address',
    ];
    
    public function settingMasterContact(){
    return $this->belongsTo('App\Models\Settings\SettingMasterContact','setting_master_contact_id','id');
    }

    public function getTitleAttribute($value)
    {
        return "{$this->house_number} {$this->district} {$this->amphure} {$this->province} {$this->postal_code}";
    }

}
