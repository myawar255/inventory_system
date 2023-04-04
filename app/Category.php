<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    //
    protected $appends = ['image_url', 'background'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/category/images/' . $this->image);
        } else {
            return 'https://ui-avatars.com/api/?background=f9f9f9&color='. str_replace("#", "", $this->background).'&size=512&bold=true&name=' . $this->name;//1ea8e7
        }
    }
    public function getBackgroundAttribute()
    {
        if ($this->color != null) {
            return $this->color;
        } else {
            return sprintf('#%06X', rand(0, 0xffffff));
        }
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
