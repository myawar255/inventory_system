<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->cover_image) {
            return asset('storage/books/images/' . $this->cover_image);
        }
        return null;
    }
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function checkreserve()
    {
        $reserve=ReservedRequest::where('book_id',$this->id)->where('user_id',auth()->id())->where('approved',0)->count();
        if ($reserve>0) {
            return true;
        }else{
            return false;
        }
    }
    public function checkborrowed()
    {
        $reserve=BorrowRequest::where('book_id',$this->id)->where('user_id',auth()->id())->where('approved',0)->count();
        if ($reserve>0) {
            return true;
        }else{
            return false;
        }
    }
 
    protected $casts = [
        'qty' => 'integer',
        'remaining' => 'integer',
    ];
}
