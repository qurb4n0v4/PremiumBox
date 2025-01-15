<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BuildABoxItemImage extends Model {
    protected $fillable = [
        'user_card_id',
        'choose_item_id',
        'image',
        'order'
    ];

    public function userCard() {
        return $this->belongsTo(UserCardForBuildABox::class, 'user_card_id');
    }

    public function chooseItem() {
        return $this->belongsTo(ChooseItem::class);
    }
}
