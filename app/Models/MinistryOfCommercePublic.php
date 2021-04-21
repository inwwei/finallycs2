<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MinistryOfCommercePublic extends Model
{
    use HasFactory, SoftDeletes, UseUuid;
    protected $fillable = [
        'name',
        'price_per_kk',
        'moisture',
        'moisture_min',
        'moisture_max',
        'Foreign_matter',
        'price_per_ton',
    ];
}
