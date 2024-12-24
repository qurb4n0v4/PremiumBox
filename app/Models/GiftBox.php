<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftBox extends Model
{
    protected $fillable = [
        'company_name',
        'title',
        'price',
        'box_category_id',
        'image'
    ];

    // If you want the image to be automatically stored as an array
    protected $casts = [
        'image' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(BoxCategory::class, 'box_category_id');
    }

    public function details()
    {
        return $this->hasMany(GiftBoxDetail::class);
    }

}
