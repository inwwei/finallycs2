<?php

namespace App\Models\Settings;

use App\Traits\UseUuid;
use App\Traits\UseLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingBasicCompany extends Model
{
    use HasFactory, SoftDeletes, UseUuid,UseLog;

    protected $appends = ['title'];

    protected $fillable = [
        'name',
        'tex_id',
        'tel',
        'house_number',
        'district',
        'amphure',
        'province',
        'postal_code',
    ];

    public function getTitleAttribute()
    {
        return "{$this->house_number} {$this->district} {$this->amphure} {$this->province} {$this->postal_code}";
    }
}
