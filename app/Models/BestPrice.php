<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BestPrice extends Model
{
    use HasFactory, SoftDeletes, UseUuid;

    protected $fillable = [
        'question',
        'company_id',
        'location',
        'name',
        'lat',
        'name_location',
        'lng',
        'price_per_kk',
        'price_per_ton',
    ];
}
