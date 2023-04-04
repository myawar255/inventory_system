<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    public function issued_book()
    {
        return $this->belongsTo(IssuedBooks::class, 'issued_book_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
