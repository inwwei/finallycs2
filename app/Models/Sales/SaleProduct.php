<?php

namespace App\Models\Sales;

use App\Traits\UseLog;
use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleProduct extends Model
{
    use HasFactory, SoftDeletes, UseUuid, UseLog;

    protected $fillable = [
        'seller_id',
        'customer_id',
        'date',
        'code',
        'sumPrice',
        'print'
    ];
  
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }
    public function employee()
    {
        return $this->belongsTo('App\Models\User','seller_id','id');
    }
    public function saleProductDetail()
    {
        return $this->hasMany('App\Models\Sales\SaleProductDetail','sell_id','id');
    }
}
