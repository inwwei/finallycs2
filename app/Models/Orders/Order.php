<?php

namespace App\Models\Orders;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes, UseUuid, UseLog;

    protected $appends = ['date'];

    protected $fillable = [
        'partner_id',
        'user_id',
        'setting_master_product_id',
        'code',
        'code_ref',
        'total_price',
        'type',
        'status',
        'print'
    ];

    public function orderDetail()
    {
        return $this->hasMany('App\Models\Orders\OrderDetail');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function orderLog()
    {
        return $this->hasMany('App\Models\Log', 'ref_id', 'id');
    }

    public function settingMasterProduct()
    {
        return $this->belongsTo('App\Models\Settings\SettingMasterProduct');
    }

    // public function customer()
    // {
    //     return $this->belongsTo('App\Models\Customer','partner_id');
    // }

    public function settingMasterCustomer()
    {
        return $this->belongsTo('App\Models\Settings\SettingMasterCustomer','partner_id');

    }

    public function getDateAttribute()
    {
        return Carbon::now()->isoFormat('D / MM / YYYY');
    }
}
