<?php

namespace App\Models\Product;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, UseUuid;

    // protected $appends = ['name','setQuantity','maxQuantity'];

    // protected $casts = [
    //     'tags' => 'array',
    // ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'name',
        'moisture',
        'moisture_min',
        'moisture_max',
        'Foreign_matter',
        'price_per_kk',
        'price_per_ton',
        'status',
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

    public function company()
    {
        return $this->belongsTo('App\Models\Company');

    }
    public function productLog()
    {
        return $this->hasMany('App\Models\Log', 'ref_id', 'id');
    }

}
