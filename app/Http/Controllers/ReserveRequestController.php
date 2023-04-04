<?php

namespace App\Http\Controllers;

use App\Book;
use App\IssuedBooks;
use App\ReservedRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;


class ReserveRequestController extends Controller
{
    public function index()
    {
        return view('reserve_request.index');
    }
    public function get_reserved_request(Request $request)
    {
        $data = ReservedRequest::select(['id', 'user_id', 'book_id', 'approved', 'created_at'])->get();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                if ($data->approved == 0) {
                    return $this->approve_button($data->id) . $this->delete_button($data->id);
                } else {
                    return $this->delete_button($data->id);
                }
            })
            ->addColumn('created_at', function ($data) {
                return Carbon::parse($data->reserve_request)->format('d M,Y');
            })
            ->addColumn('user_name', function ($data) {
                return $data->user()->withTrashed()->first()->complete_name_styled();
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
            ->rawColumns(['action', 'created_at', 'user_name', 'book_name', 'approved'])
            ->make(true);
    }

    public function add_reserved_request()
    {
        $users = User::role(['student', 'faculty'])->get();
        $books = Book::get();
        return view('reserve_request.add_request', compact('users', 'books'));
    }

    public function save_reserved_request(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'user_name' => 'required',
                'book_name' => 'required',
            ],
        );
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 500);
        }
        $data = new ReservedRequest();
        $data->user_id = $request->user_name;
        $data->book_id = $request->book_name;
        $data->save();
        return 'Success';
    }

    public function delete_reserved_request($id)
    {
        $data = ReservedRequest::find($id);
        $data->delete();

        return 'Deleted Successfully';
    }

    public function show_reserve_approve_req($id)
    {
        $data['reserve'] = ReservedRequest::find($id);
        return view('reserve_request.modal.approve', $data);
    }

    public function approve_reserve(Request $request)
    {
        $data = ReservedRequest::find($request->id);
        $data->approved = 1;
        $data->save();
        $user = new IssuedBooks();
        $user->book_id = $data->book_id;
        $user->user_id = $data->user_id;
        $user->issued_date = $data->issue_date;
        $user->return_date = $data->return_date;
        $user->return_status = 'Issued';
        $user->save();

        $book = Book::find($data->book_id);
        $book->remaining = $book->remaining - 1;
        $book->save();
        return  'Success';
    }
}
