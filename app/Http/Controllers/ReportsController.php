<?php

namespace App\Http\Controllers;

use App\Book;
use App\IssuedBooks;
use App\RenewRequest;
use App\RequestedBooks;
use App\ReservedRequest;
use App\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }
    public function reports_print()
    {
        return view('reports.print');
    }

    public function reports_getData($type)
    {
        if ($type== 'total_books') {
            return Book::sum('qty');
        }
        if ($type== 'issued_books') {
            return IssuedBooks::where('return_status','Issued')->count();
        }
        if ($type== 'returned_books') {
            return IssuedBooks::where('return_status', 'return')->count();
        }
        if ($type== 'requested_books') {
            return RequestedBooks::count();
        }
        if ($type== 'reserved_books') {
            return ReservedRequest::count();
        }
        if ($type== 'renewed_books') {
            return RenewRequest::count();
        }
        if ($type== 'total_users') {
            return User::count();
        }
        if ($type== 'total_students') {
            return User::role('student')->count();
        }
        if ($type== 'total_faculty') {
            return User::role('faculty')->count();
        }

    }
}
