<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateGift extends Model
{
    use HasFactory;

    protected $table = 'corporate_gifts';

    protected $fillable = [
        'image',
        'title',
        'paragraph'
    ];
}
