<?php

namespace App\Models\Sales;

use App\Traits\UseLog;
use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleProductDetail extends Model
{
    use HasFactory, SoftDeletes, UseUuid, UseLog;

    protected $appends = ['totalPrice'];

    protected $fillable = [
        'sell_id',
        'product_id',
        'amount',
        'wholesale_price',
        'total_price'
    ];
    public function employee()
    {
        return $this->belongsTo('App\Models\Customer','sell_id','id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product','product_id','id');
    }
    public function getTotalPriceAttribute()
    {
        return $this->amount * $this->product->retail_price;
    }
}
