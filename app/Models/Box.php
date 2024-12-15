<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_small',
        'title_large',
        'description',
        'button_text',
        'image',
        'link',
        'color',
    ];
}
