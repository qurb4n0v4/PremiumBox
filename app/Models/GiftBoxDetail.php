<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftBoxDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'gift_box_id',
        'images',
        'box_name',
        'available_same_day_delivery',
        'paragraph',
        'additional',
    ];

    protected $casts = [
        'images' => 'array',
        'available_same_day_delivery' => 'boolean',
    ];


    public function giftBox()
    {
        return $this->belongsTo(GiftBox::class);
    }
}
