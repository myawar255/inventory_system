<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestedBooks extends Model
{
    protected $table = 'requested_books';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
