<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCardForBuildABox extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'gift_box_id', 'box_customization_text', 'selected_font',
        'card_id', 'recipient_name', 'sender_name', 'card_message', 'status'
    ];

    // İlişkili modellər
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function giftBox()
    {
        return $this->belongsTo(GiftBox::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function items()
    {
        return $this->hasMany(UserBuildABoxCardItem::class);
    }

    public function cardImages()
    {
        return $this->hasMany(BuildABoxCardImage::class);
    }
}
