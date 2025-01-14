<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BuildABoxCardImage extends Model {
    protected $fillable = [
        'user_card_id',
        'card_id',
        'image',
        'order'
    ];

    public function userCard() {
        return $this->belongsTo(UserCardForBuildABox::class, 'user_card_id');
    }

    public function card() {
        return $this->belongsTo(Card::class);
    }
}
