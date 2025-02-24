<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'paragraph', 'image'];

    public function blogDetails()
    {
        return $this->hasMany(BlogDetail::class, 'blog_id');
    }

}
