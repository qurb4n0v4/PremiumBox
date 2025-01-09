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
        'has_custom_text',         // Add this line
        'text_field_placeholder',  // Add this line
    ];

    protected $casts = [
        'images' => 'array',        // Ensure this casts correctly to an array
        'available_same_day_delivery' => 'boolean',
        'has_variants' => 'boolean',
        'variants' => 'array',      // Ensure this casts correctly to an array
        'has_custom_text' => 'boolean',  // Ensure this casts correctly to a boolean
    ];

    public function chooseItem(): BelongsTo
    {
        return $this->belongsTo(ChooseItem::class, 'choose_item_id');
    }
}
