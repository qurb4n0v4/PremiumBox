<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCardDetail extends Model
{
    protected $fillable = [
        'user_card_for_premade_box_id',
        'card_id',
        'to_name',
        'from_name',
        'message'
    ];

    public function userCardForPremadeBox()
    {
        return $this->belongsTo(UserCardForPremadeBox::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }
}
