<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ChooseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'name',
        'price',
        'button',
        'normal_image',
        'hover_image',
        'category',
        'production_time',
        'width',
        'height',
        'length',
    ];


    public function customProductDetail(): HasOne
    {
        return $this->hasOne(CustomProductDetail::class, 'choose_item_id');
    }

    public function chooseVariant(): HasOne
    {
        return $this->hasOne(ChooseVariant::class, 'choose_item_id');
    }

    public function chooseVariants()
    {
        return $this->hasMany(ChooseVariant::class, 'choose_item_id');
    }

    public function customProductDetails()
    {
        return $this->hasOne(CustomProductDetail::class);
    }

    public function getItemVolumeAttribute()
    {
        return $this->length * $this->width * $this->height;
    }
}
