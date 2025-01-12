<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremadeBoxInsiding extends Model
{
    use HasFactory;

    protected $fillable = [
        'premade_boxes_id',
        'name',
        'image',
        'allow_image_upload',
        'image_upload_title',
        'max_image_count',
        'allow_text',
        'text_field_placeholder',
        'allow_variant_selection',
        'variant_options',
        'quantity',
    ];

    protected $casts = [
        'variant_options' => 'array',
    ];

    public function premadeBoxDetail()
    {
        return $this->belongsTo(PremadeBoxDetail::class);
    }

    public function premadeBox()
    {
        return $this->belongsTo(PremadeBox::class, 'premade_boxes_id');
    }
}
