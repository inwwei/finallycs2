<?php

namespace App\Models\Orders;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes, UseUuid,UseLog;
    protected $fillable = [
        'order_id',
        'setting_master_product_id',
        'ref_id',
        'recieve_date',
        'vin',
        'serial_number',
        'amount',
        'amount_recieve',
        'wholesale_price',
        'total_price',
        'type',
        'description',
        'retail_price'
    ];

    public function order(){
        return $this->belongsTo('App\Models\Orders\Order','order_id');
        }
    public function settingMasterProduct(){
        return $this->belongsTo('App\Models\Settings\SettingMasterProduct','setting_master_product_id');
        }
    public function orderDetailLog()
        {
            return $this->hasMany('App\Models\Log','ref_id','id');
        }
}
