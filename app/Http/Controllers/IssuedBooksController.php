<?php

namespace App\Http\Controllers;

use App\Book;
use App\IssuedBooks;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class IssuedBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::role(['student', 'faculty'])->get();
        return view('issued_books.index', compact('users'));
    }

    public function get_data()
    {
        $data = IssuedBooks::with(['user' => function ($query) {
            $query->withTrashed();
        }], 'book')->select(['id', 'user_id', 'book_id', 'issued_date', 'return_date', 'return_status', 'fine']);
        return DataTables::of($data)
            ->addColumn('lib_id', function ($data) {
                return 'lib_' . $data->id;
            })
            ->addColumn('action', function ($data) {

                return ($data->user->deleted_at != null ? '' : $this->edit_button($data->id)) . $this->delete_button($data->id);
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
            ->rawColumns(['lib_id', 'action', 'user_name', 'book_name'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::role(['student', 'faculty'])->get();
        $books = Book::get();
        return view('issued_books.modal.add', compact('users', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'book_name' => 'required',
                'user_name' => 'required',
                'issue_date' => 'required',
                'return_date' => 'required',
            ],
        );
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 500);
        }
        $book = Book::find($request->book_name);
        // dd($book);
        if ($book->remaining < 1) {
            return response()->json('Currently Book not Available', 500);
        }
        $user = new IssuedBooks();
        $user->book_id = $request->book_name;
        $user->user_id = $request->user_name;
        $user->issued_date = $request->issue_date;
        $user->return_date = $request->return_date;
        $user->return_status = 'Issued';
        $user->save();
        $book->remaining = $book->remaining - 1;
        $book->save();

        return 'Success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = IssuedBooks::find($id);
        $users = User::role(['student', 'faculty'])->get();
        $book = Book::where('id', $data->book_id)->first();
        return view('issued_books.modal.edit', compact('data', 'book', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'book_name' => 'required',
                'user_name' => 'required',
                'issue_date' => 'required',
                'return_date' => 'required',
            ],
        );
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 500);
        }
        $user = IssuedBooks::find($request->id);
        $user->book_id = $request->book_name;
        $user->user_id = $request->user_name;
        $user->issued_date = $request->issue_date;
        $user->return_date = $request->return_date;
        $user->return_status = 'Issued';
        $user->save();
        return 'Updated Successfully';
    }

    public function return_issuedBooks(Request $request)
    {

        if ($request->returnRadio == 'user_name') {
            $block = 'user_id';
        } else {
            $validate = Validator::make(
                $request->all(),
                [
                    'id' => 'required',
                ],
            );
            if ($validate->fails()) {
                return response()->json($validate->errors()->first(), 500);
            }
            $block =  'id';
            $request['id'] = explode("_", $request->id)[1];
        }

        $issued_books = IssuedBooks::with('book')->where('return_status', 'Issued')->where($block, $request->$block)->get();

        return $issued_books;
    }
    public function return_book($id)
    {
        $return_book = IssuedBooks::find($id);
        $data = Book::find($return_book->book_id);
        return view('issued_books.modal.returnBookDetail', compact('return_book', 'data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = IssuedBooks::find($id);
        $book = Book::find($data->book_id);
        $book->remaining = $book->remaining + 1;
        $book->save();
        $data->delete();
        return 'Deleted Succesfully';
    }

    public function return_book_data(Request $request)
    {
        $issued_books = IssuedBooks::find($request->id);
        $issued_books->fine = $request->fine;
        $issued_books->return_status = 'return';
        $issued_books->return_date = now();
        $issued_books->save();
        $book = Book::where('id', $issued_books->book_id)->first();
        $book->remaining = $book->remaining + 1;
        $book->save();

        return 'Success';
    }

    public function check_book_availability(Request $request)
    {
        $book = Book::find($request->book_id);
        return $book->remaining;
    }
}
