<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCardForPremadeBox extends Model
{
    protected $fillable = [
        'user_id',
        'premade_box_id',
        'gift_box_id',
        'box_text',
        'selected_font',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function premadeBox()
    {
        return $this->belongsTo(PremadeBox::class, 'premade_box_id');
    }

    public function userCardDetails()
    {
        return $this->hasMany(UserCardDetail::class);
    }
    public function items()
    {
        return $this->hasMany(UserPremadeBoxItem::class, 'user_card_for_premade_box_id');
    }

    public function premadeBoxItems()
    {
        return $this->hasMany(UserPremadeBoxItem::class);
    }
    public function giftBox()
    {
        return $this->belongsTo(GiftBox::class, 'gift_box_id');
    }
}
