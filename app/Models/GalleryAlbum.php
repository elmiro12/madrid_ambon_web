<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryAlbum extends Model
{
    protected $table = 'gallery_albums';
    protected $fillable = ['title','name','deskripsi', 'is_image'];
    

    public function galleries(){
        return $this->hasMany(Gallery::class, 'album_id');
    }
}

