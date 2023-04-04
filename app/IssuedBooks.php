<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssuedBooks extends Model
{
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkrenew()
    {
        $renew = RenewRequest::where('issued_book_id', $this->id)->where('user_id', auth()->id())->where('approved', 0)->count();
        if ($renew > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function checkreturn()
    {
        $return = ReturnRequest::where('issued_book_id', $this->id)->where('user_id', auth()->id())->where('approved', 0)->count();
        if ($return > 0) {
            return true;
        } else {
            return false;
        }
    }
}
