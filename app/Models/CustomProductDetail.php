<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomProductDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        // Əsas Məlumatlar
        'choose_item_id',
        'same_day_delivery',
        'description',
        'images', // Əsas məhsul şəkilləri

        // Şəkil Yükləmə Parametrləri
        'allow_user_images',
        'image_upload_title',
        'max_image_count',

        // Variant Parametrləri
        'has_variants',
        'variant_selection_title',
        'variants', // JSON: [{ name: string, image: string, price: numeric }]

        // Mətn Sahəsi Parametrləri
        'has_custom_text',
        'text_field_placeholder',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'variants' => 'array',
        'images' => 'array',
        'same_day_delivery' => 'boolean',
        'allow_user_images' => 'boolean',
        'has_variants' => 'boolean',
        'has_custom_text' => 'boolean',
        'max_image_count' => 'integer',
    ];

    /**
     * Get the choose item that owns the custom product detail.
     *
     * @return BelongsTo
     */
    public function chooseItem(): BelongsTo
    {
        return $this->belongsTo(ChooseItem::class, 'choose_item_id');
    }
}
