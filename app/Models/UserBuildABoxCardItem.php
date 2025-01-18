<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBuildABoxCardItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_card_id', 'choose_item_id', 'selected_variants', 'user_text'
    ];

    // İlişkili modellər
    public function userCard()
    {
        return $this->belongsTo(UserCardForBuildABox::class);
    }

    public function chooseItem()
    {
        return $this->belongsTo(ChooseItem::class);
    }

    public function itemImages()
    {
        return $this->hasMany(BuildABoxItemImage::class);
    }
}
