<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremadeBoxDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'premade_box_id',
        'insiding',
        'paragraph',
        'images',
        'recipient',
        'occasion',
        'production_time',
    ];

    protected $casts = [
        'insiding' => 'array',
        'images' => 'array',
    ];

    public function premadeBox()
    {
        return $this->belongsTo(PremadeBox::class);
    }}
