<?php

namespace App\Http\Controllers;

use App\Book;
use App\IssuedBooks;
use App\RequestedBooks;
use App\ReservedRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function get_issued_books()
    {
        $books = IssuedBooks::with('book')->where('user_id', auth()->id())->where('return_status', 'issued')->get();
        return view('profile.issued_books', compact('books'));
    }
    public function get_returned_books()
    {
        $issuebook = IssuedBooks::with('book')->where('user_id', auth()->id())->where('return_status', 'return')->pluck('book_id');
        $books = Book::whereIn('id', $issuebook)->get();
        return view('profile.returned_books', compact('books'));
    }
    public function get_requested_books()
    {
        $books = RequestedBooks::where('user_id', auth()->id())->get();
        return view('profile.requested_books', compact('books'));
    }
    public function get_reserved_books()
    {
        $issuebook = ReservedRequest::where('user_id', auth()->id())->pluck('book_id');
        $books = Book::whereIn('id', $issuebook)->get();
        return view('profile.reserved_books', compact('books'));
    }
    public function getData($type)
    {
        if ($type == 'issued_books') {
            return IssuedBooks::where('user_id', auth()->id())->where('return_status', 'issued')->count();
        }
        if ($type == 'returned_books') {
            return IssuedBooks::where('user_id', auth()->id())->where('return_status', 'return')->count();
        }
        if ($type == 'requested_books') {
            return RequestedBooks::where('user_id', auth()->id())->count();
        }
        if ($type == 'reserved_books') {
            return ReservedRequest::where('user_id', auth()->id())->count();
        }
    }
}
