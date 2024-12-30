<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    protected $table = 'privacy_policies';

    protected $fillable = [
        'effective_date',
        'sections',
        'introduction'
    ];

    // Use a mutator to ensure sections are always stored as JSON
    public function setSectionsAttribute($value)
    {
        $this->attributes['sections'] = is_array($value)
            ? json_encode($value)
            : $value;
    }

    // Use an accessor to always return an array
    public function getSectionsAttribute($value)
    {
        return is_string($value)
            ? json_decode($value, true)
            : $value;
    }

    protected $casts = [
        'effective_date' => 'date',
    ];
}
