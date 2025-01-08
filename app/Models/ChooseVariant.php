<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChooseVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'choose_item_id',
        'images',
        'available_same_day_delivery',
        'paragraph',
        'has_variants',
        'variant_selection_title',
        'variants',
    ];


    protected $casts = [
        'images' => 'array',
        'available_same_day_delivery' => 'boolean',
        'has_variants' => 'boolean',
        'variants' => 'array',
    ];


    public function chooseItem(): BelongsTo
    {
        return $this->belongsTo(ChooseItem::class, 'choose_item_id');
    }
}
