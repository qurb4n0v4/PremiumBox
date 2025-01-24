<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPremadeBoxItemImage extends Model
{
    protected $fillable = [
        'user_premade_box_item_id',
        'image_path',
        'order'
    ];

    public function userPremadeBoxItem()
    {
        return $this->belongsTo(UserPremadeBoxItem::class);
    }
}
