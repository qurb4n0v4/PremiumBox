<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateGift extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'corporate_gifts';

    // The attributes that are mass assignable
    protected $fillable = [
        'image',
        'title',
        'paragraph',
        'description', // Assuming you have a description column
        'images' // This field holds JSON data for multiple images
    ];

    // Automatically cast the `images` field to/from an array
    protected $casts = [
        'images' => 'array',
    ];
}
