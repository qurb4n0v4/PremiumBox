<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCardForBuildABox extends Model
{
    use HasFactory;

    protected $table = 'user_card_for_build_a_box';

    protected $fillable = [
        'user_id',
        'gift_box_id',
        'box_customization_text',
        'selected_font',
        'card_id',
        'recipient_name',
        'sender_name',
        'card_message',
        'status',
    ];


    // İlişkili modellər
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function giftBox()
    {
        return $this->belongsTo(GiftBox::class, 'gift_box_id');
    }

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    public function items()
    {
        return $this->hasMany(UserBuildABoxCardItem::class, 'user_card_id');
    }

    public function Images()
    {
        return $this->hasMany(BuildABoxCardImage::class, 'user_card_id', 'id');
    }
    public function cardItems()
    {
        return $this->hasMany(UserBuildABoxCardItem::class, 'user_card_id');
    }
    public function userBuildABoxCardItems()
    {
        return $this->hasMany(UserBuildABoxCardItem::class, 'user_card_id');
    }
}
