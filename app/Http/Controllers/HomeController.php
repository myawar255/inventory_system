<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('reports.index');
        }
        if (auth()->user()->hasRole('librarian')) {
            return redirect()->route('book.index');
        }
        if (auth()->user()->hasRole('student')) {
            return redirect()->route('book.user');
        }
        if (auth()->user()->hasRole('faculty')) {
            return redirect()->route('book.user');
        }
        return view('home');
    }
}
