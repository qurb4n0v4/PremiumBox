<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'same_day_delivery',
        'description',
        'images',
        'require_user_images',
        'user_image_title',
        'user_image_limit',
        'require_user_choices',
        'user_choice_title',
        'user_choices',
        'require_textarea',
        'textarea_placeholder',
    ];

    protected $casts = [
        'images' => 'array',
        'user_choices' => 'array',
    ];

    // Əlavə funksiya və ya əlaqələr buraya əlavə edilə bilər
}
