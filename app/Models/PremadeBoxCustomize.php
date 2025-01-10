<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremadeBoxCustomize extends Model
{
    use HasFactory;

    protected $table = 'premade_box_customize';

    protected $fillable = [
        'premade_boxes_id',
        'gift_box_id',
        'name',
        'boxes',
    ];

    protected $casts = [
        'boxes' => 'array',
    ];

    public function premadeBox()
    {
        return $this->belongsTo(PremadeBox::class);
    }

    public function giftBox()
    {
        return $this->belongsTo(GiftBox::class);
    }
}
