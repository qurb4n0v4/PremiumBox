<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'choose_item_id',
        'same_day_delivery',
        'description',
        'images',

        'allow_user_images',
        'image_upload_title',
        'max_image_count',

        'has_variants',
        'variant_selection_title',
        'variants',

        'has_custom_text',
        'text_field_placeholder',
    ];


    protected $casts = [
        'variants' => 'array',
        'images' => 'array',
        'same_day_delivery' => 'boolean',
        'allow_user_images' => 'boolean',
        'has_variants' => 'boolean',
        'has_custom_text' => 'boolean',
        'max_image_count' => 'integer',
    ];


    public function chooseItem(): BelongsTo
    {
        return $this->belongsTo(ChooseItem::class, 'choose_item_id');
    }
}
