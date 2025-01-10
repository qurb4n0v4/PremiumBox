<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremadeBox extends Model
{
    use HasFactory;

    protected $table = 'premade_boxes';

    protected $fillable = [
        'name',
        'title',
        'price',
        'normal_image',
        'hover_image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function details()
    {
        return $this->hasMany(PremadeBoxDetail::class, 'premade_box_id');
    }

    public function insidings()
    {
        return $this->hasMany(PremadeBoxInsiding::class, 'premade_boxes_id', 'id');
    }
}
