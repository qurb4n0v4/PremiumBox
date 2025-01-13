<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremadeBoxDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'premade_box_id',
        'paragraph',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function premadeBox()
    {
        return $this->belongsTo(PremadeBox::class, 'premade_box_id');
    }

    public function premadeBoxInsidings()
    {
        return $this->hasMany(PremadeBoxInsiding::class);
    }
}
