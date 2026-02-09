<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug','summary','keywords','hits','category_id','image', 'is_published'];


    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

}
