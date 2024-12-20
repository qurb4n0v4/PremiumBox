<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopUpHome extends Model
{
    use HasFactory;

    protected $fillable = ['title1', 'image1', 'title2', 'image2'];
}
