<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'content', 'slug','menu_id','hits','is_active','is_carousel','image','icon'];

    public function parentMenu()
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }

}

