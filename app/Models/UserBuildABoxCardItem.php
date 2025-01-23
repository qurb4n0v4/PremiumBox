<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBuildABoxCardItem extends Model
{
    use HasFactory;

    protected $table = 'user_build_a_box_card_items';

    protected $fillable = [
        'user_card_id',
        'choose_item_id',
        'selected_variants',
        'user_text',
    ];

    // İlişkili modellər
    public function userCard()
    {
        return $this->belongsTo(UserCardForBuildABox::class);
    }

    public function chooseItem()
    {
        return $this->belongsTo(ChooseItem::class, 'choose_item_id');
    }
//    public function chooseItems()
//    {
//        return $this->hasManyThrough(
//            ChooseItem::class,
//            UserBuildABoxCardItem::class,
//            'user_card_id',    // Foreign key on UserBuildABoxCardItem table
//            'id',              // Foreign key on ChooseItem table
//            'id',              // Local key on UserCardForBuildABox table
//            'choose_item_id'   // Local key on UserBuildABoxCardItem table
//        );
//    }

    public function images()
    {
        return $this->hasMany(BuildABoxItemImage::class, 'user_build_a_box_card_item_id');
    }
}
