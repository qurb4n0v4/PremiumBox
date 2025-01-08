<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'receiver_name',
        'phone_number',
        'zip_code',
        'district',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
