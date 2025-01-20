<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildABoxItemImage extends Model
{
    use HasFactory;

    protected $table = 'build_a_box_item_images';

    protected $fillable = [
        'user_build_a_box_card_item_id',
        'choose_item_id',
        'image',
        'order',
    ];

    // İlişkili modellər
    public function userBuildABoxCardItem()
    {
        return $this->belongsTo(UserBuildABoxCardItem::class);
    }

    public function chooseItem()
    {
        return $this->belongsTo(ChooseItem::class);
    }
}
