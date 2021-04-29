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
        'company_id',
        'plant_id',
        'name',
        'price',
    ];
}
