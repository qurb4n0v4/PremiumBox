<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    protected $fillable = [
        'name',
        'image',
        'price',
    ];

    /**
     * Kartın şəkilini alın.
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
