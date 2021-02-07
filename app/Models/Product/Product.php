<?php

namespace App\Models\Product;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, UseUuid,UseLog;

    protected $appends = ['name','setQuantity','maxQuantity'];

    protected $casts = [
        'tags' => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'setting_master_product_id',
        'setting_basic_branch_id',
        'machine_code',
        'vin',
        'description',
        'quantity',
        'retail_price',
        'wholesale_price',
        'tags',
        'date',
        'type_received',
        'received_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function settingBasicBranch()
    {
        return $this->belongsTo('App\Models\Settings\SettingBasicBranch');

    }
    public function attacheds()
    {
        return $this->morphMany('App\Models\Attached', 'attachedable');
    }
    public function settingMasterProduct()
    {
        return $this->belongsTo('App\Models\Settings\SettingMasterProduct');

    }
    public function productLog()
    {
        return $this->hasMany('App\Models\Log','ref_id','id');
    }
    public function getNameAttribute($value)
    {
        // return $this->settingMasterProduct;
         return "({$this->settingMasterProduct->name_th}) ({$this->settingMasterProduct->name_en})";

    }

    public function getMaxQuantityAttribute($value)
    {
        // return $this->settingMasterProduct;
        return $this->quantity;
    }

    public function getSetQuantityAttribute($value)
    {
        // return $this->settingMasterProduct;
        if($this->quantity !== 0){
            return 1;
        }else{
            return 0;
        }


    }

}
