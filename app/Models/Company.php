<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Model
{
    use HasApiTokens, HasFactory, Notifiable, UseUuid, SoftDeletes;

    protected $appends = ['fullname','address'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'branch',
        'identification_number',
        'email',
        'ceo_prefix',
        'ceo_firstname',
        'ceo_lastname',
        'company_tel',
        'ceo_tel',
        'amphoe',
        'district',
        'province',
        'postal_code',
        'lat',
        'lng',
        'zoom',
        'name_location'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function product()
    {
        return $this->hasMany('App\Models\Product\Product');
    }
    public function getFullNameAttribute($value)
    {
         return "{$this->ceo_prefix}{$this->name_en} {$this->ceo_firstname}";
    }
    public function getAddressAttribute($value)
    {
        // return "{$this->amphoe}|{$this->district}|{$this->province}|{$this->postal_code}";

        return "ตำบล{$this->district} อำเภอ{$this->amphoe} จังหวัด{$this->province} รหัสไปรษณีย์{$this->postal_code}";
    }
}
