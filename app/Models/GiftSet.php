<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftSet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'normal_image',
        'hover_image',
    ];
}
