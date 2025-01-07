<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChooseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'name',
        'price',
        'button',
        'normal_image',
        'hover_image',
    ];
}
