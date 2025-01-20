<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'width', 'height', 'length'];

    protected $appends = ['boxVolume'];

    public function boxes()
    {
        return $this->hasMany(GiftBox::class, 'box_category_id');
    }

    public function getBoxVolumeAttribute()
    {
        return $this->length * $this->width * $this->height;
    }
}
