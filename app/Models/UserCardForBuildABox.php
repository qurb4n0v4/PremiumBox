<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserCardForBuildABox extends Model {

    protected $table = 'user_card_for_build_a_box';

    protected $fillable = [
        'user_id',
        'gift_box_id',
        'box_customization_text',
        'selected_font',
        'choose_item_id',
        'selected_variants',
        'user_text',
        'card_id',
        'recipient_name',
        'sender_name',
        'card_message',
        'status'
    ];

    protected $casts = [
        'selected_variants' => 'array'
    ];

    public function itemImages() {
        return $this->hasMany(BuildABoxItemImage::class, 'user_card_id');
    }

    public function cardImages() {
        return $this->hasMany(BuildABoxCardImage::class, 'user_card_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function giftBox() {
        return $this->belongsTo(GiftBox::class);
    }

    public function chooseItem() {
        return $this->belongsTo(ChooseItem::class);
    }

    public function card() {
        return $this->belongsTo(Card::class);
    }
}
