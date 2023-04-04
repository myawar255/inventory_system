<?php

namespace App\Http\Controllers;

use App\Book;
use App\IssuedBooks;
use App\ReturnRequest;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ReturnRequestController extends Controller
{
    public function index()
    {
        return view('return_request.index');
    }

    public function get_return_request(Request $request)
    {
        $data = ReturnRequest::with(['user' => function ($query) {
            $query->withTrashed();
        }],'issued_book')->select(['id', 'user_id', 'approved', 'issued_book_id'])->latest();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                if ($data->approved == 0) {
                    return $this->approve_button($data->id) . $this->delete_button($data->id);
                } else {
                    return $this->delete_button($data->id);
                }
            })
            ->addColumn('issued_book_id', function ($data) {
                return 'lib_' . $data->issued_book_id;
            })
            ->addColumn('user_name', function ($data) {
                return $data->user->complete_name_styled();
            })
            ->addColumn('book_name', function ($data) {
                if (strlen($data->issued_book->book->name) > 70) {
                    return substr($data->issued_book->book->name, 0, 70) . '...';
                } else {
                    return $data->issued_book->book->name;
                }
            })
            ->addColumn('approved', function ($data) {
                if ($data->approved == 0) {
                    return "Pending";
                } else {
                    return "Approved";
                }
            })
            ->rawColumns(['action', 'user_name', 'book_name', 'approved'])
            ->make(true);
    }

    public function add_return_request()
    {
        $users = User::role(['student', 'faculty'])->get();
        $books = IssuedBooks::get();
        return view('return_request.add_request', compact('users', 'books'));
    }

    public function save_return_request(Request $request)
    {
        $issued = IssuedBooks::find($request->issued_book_id);
        $data = new ReturnRequest();
        $data->user_id = $issued->user_id;
        $data->issued_book_id =  $request->issued_book_id;
        $data->save();
        if ($request->redirect == true) {
            return redirect()->back();
        }
        return 'Success';
    }

    public function delete_return_request($id)
    {
        $data = ReturnRequest::find($id);
        $data->delete();

        return 'Deleted Successfully';
    }

    public function show_return_approve_req($id)
    {
        $data['return'] = ReturnRequest::find($id);
        return view('return_request.modal.approve', $data);
    }

    public function approve_return(Request $request)
    {
        $data = ReturnRequest::find($request->id);
        $data->approved = 1;
        $data->save();
        $issue = IssuedBooks::find($data->issued_book_id);
        $issue->return_status = "return";
        $issue->fine = $request->fine;
        $issue->save();

        $book = Book::find($issue->book_id);
        $book->remaining = $book->remaining + 1;
        $book->save();
        // dd($book);
        return  'Success';
    }
}
