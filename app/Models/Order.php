<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gift_box_id',
        'bag_id',
        'card_id',
        'recipient_name',
        'sender_name',
        'box_contents',
        'status',
    ];

    // Kullanıcı ilişkisi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Hediye Kutusu ilişkisi
    public function giftBox()
    {
        return $this->belongsTo(GiftBox::class);
    }

    // Çanta ilişkisi
    public function bag()
    {
        return $this->belongsTo(Bag::class);
    }

    // Kart ilişkisi
    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
