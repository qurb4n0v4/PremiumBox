<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'blog_details',
    ];

    protected $casts = [
        'blog_details' => 'array',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
