<?php

namespace App\Http\Controllers;

use App\Book;
use App\BorrowRequest;
use App\IssuedBooks;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;



class BorrowRequestController extends Controller
{
    public function index()
    {
        return view('borrow_request.index');
    }

    public function get_borrow_request(Request $request)
    { {
            $data = BorrowRequest::with(['user' => function ($query) {
                $query->withTrashed();
            }], 'book')->select(['id', 'user_id', 'book_id', 'issue_date', 'return_date', 'approved']);
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    if ($data->approved == 0) {
                        return  $this->approve_button($data->id) . $this->delete_button($data->id);
                    } else {
                        return  $this->delete_button($data->id);
                    }
                })
                ->addColumn('user_name', function ($data) {
                    return $data->user->complete_name_styled();
                })
                ->addColumn('book_name', function ($data) {
                    if (strlen($data->book->name) > 70) {
                        return substr($data->book->name, 0, 70) . '...';
                    } else {
                        return $data->book->name;
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
    }

    public function add_borrow_request()
    {
        $users = User::role(['student', 'faculty'])->get();
        $books = Book::get();
        return view('borrow_request.add_request', compact('users', 'books'));
    }

    public function save_borrow_request(Request $request)
    {
        $user = new BorrowRequest();
        $user->book_id = $request->book_name;
        $user->user_id = $request->user_name;
        $user->issue_date = $request->issue_date;
        $user->return_date = $request->return_date;
        $user->save();

        return 'Success';
    }

    public function delete_borrow_request($id)
    {
        $data = BorrowRequest::find($id);
        $data->delete();

        return 'Deleted Successfully';
    }

    public function show_borrow_approve_req($id)
    {
        $data['borrow'] = BorrowRequest::find($id);
        return view('borrow_request.modal.approve', $data);
    }

    public function approve_borrow(Request $request)
    {
        // dd($request->all());
        $borrow = BorrowRequest::find($request->id);
        $borrow->approved = 1;
        $borrow->save();
        $book = Book::find($borrow->book_id);
        if ($book->remaining < 1) {
            return response()->json('Currently Book not Available', 500);
        }
        $issue = new IssuedBooks();
        $issue->user_id = $borrow->user_id;
        $issue->book_id = $borrow->book_id;
        $issue->issued_date = $request->issue_date;
        $issue->return_date = $request->return_date;
        $issue->return_status = "Issued";
        $issue->save();
        $book->remaining = $book->remaining - 1;
        $book->save();

        return "approved";
    }
}
