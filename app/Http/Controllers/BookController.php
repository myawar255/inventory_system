<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use App\Category;
use App\IssuedBooks;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(auth()->user()->complete_name());
        $cat_id = $request->cat_id;
        $category = Category::find($cat_id);
        return view('books.index', compact('cat_id', 'category'));
    }

    public function get_data(Request $request)
    {
        $cat_id = $request->cat_id;
        if ($cat_id != null) {
            $data = Book::where('category_id', $cat_id)->with('author', 'category')->select(['id', 'qty', 'remaining', 'isbn_number', 'name', 'category_id', 'author_id', 'price'])->latest();
        } else {
            $data = Book::with('author', 'category')->select(['id', 'qty', 'remaining', 'isbn_number', 'name', 'category_id', 'author_id', 'price'])->latest();
        }
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $view_btn = $this->viewButton($data->id);
                $edit_delete_btn = $this->get_buttons($data->id);
                return $view_btn . $edit_delete_btn;
            })
            ->addColumn('category', function ($data) {
                return '<span class="badge" style="background:' . $data->category->background . ';font-size: 1em;">' . $data->category->name . '</span>';
            })
            ->addColumn('author', function ($data) {
                return $data->author->name;
            })
            ->addColumn('name', function ($data) {
                if (strlen($data->name) > 70) {
                    return substr($data->name, 0, 70) . '...';
                } else {
                    return $data->name;
                }
            })
            ->rawColumns(['name', 'action', 'category', 'author'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::get();
        $data['authors'] = Author::get();

        return view('books.modal.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:books,name',
                'isbn_number' => 'required',
                'desc' => 'required',
                'price' => 'required|integer',
                'qty' => 'required|integer',
                'category' => 'required',
                'published_date' => 'required',
                'author' => 'required',
                'image' => 'required|image|max:2048' // validate that the uploaded file is an image and its size is less than or equal to 2MB
            ],
        );
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 500);
        }

        $data = new Book();
        $data->isbn_number = $request->isbn_number;
        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->price = $request->price;
        $data->qty = $request->qty;
        $data->remaining = $request->qty;
        $data->published_date = $request->published_date;
        $data->category_id = $request->category;
        $data->author_id = $request->author;

        $slug = Str::slug($request->name);
        $image = $request->file('image');
        $randomString = Str::random(5);
        $imageName = $slug . '_' . $randomString . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/books/images', $imageName);
        $data->cover_image = $imageName;

        $data->save();
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
        $data['categories'] = Category::get();
        $data['authors'] = Author::get();
        $data['data'] = Book::find($id);
        return view('books.modal.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['categories'] = Category::get();
        $data['authors'] = Author::get();
        $data['data'] = Book::find($id);
        return view('books.modal.edit', $data);
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
                'name' => 'required|unique:categories,name,' . $id,
                'isbn_number' => 'required',
                'desc' => 'required',
                'price' => 'required',
                'category' => 'required',
                'published_date' => 'required',
                'author' => 'required',
                'image' => 'nullable|image|max:2048' // validate that the uploaded file is an image and its size is less than or equal to 2MB
            ],
        );
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 500);
        }

        $data = Book::find($id);
        $data->isbn_number = $request->isbn_number;
        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->price = $request->price;
        $data->published_date = $request->published_date;
        $data->category_id = $request->category;
        $data->author_id = $request->author;

        $slug = Str::slug($request->name);
        if ($request->hasFile('image')) {
            //check for old image file
            $imagePath = 'public/books/images/' . $data->image;

            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            //save image file
            $image = $request->file('image');
            $randomString = Str::random(5);
            $imageName = $slug . '_' . $randomString . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/books/images', $imageName);
            $data->cover_image = $imageName;
        }

        $data->save();
        return 'Success';
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Book::findOrFail($id);
        $imagePath = 'public/books/images/' . $data->image;

        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        $data->delete();
        return 'Book Deleted Successfully';
    }


    public function user_books(Request $request)
    {
        $data['books'] =
            Book::query()->when($request->name != null, function ($query) use ($request) {
                return $query->where('name', 'LIKE', '%' . $request->name . '%');
            })->when($request->category, function ($query) use ($request) {
                return $query->where('category_id', $request->category);
            })
            ->get();
        if ($request->name != null) {
            $data['search_string'] = $request->name;
        }
        if ($request->category) {
            $data['search_category'] = Category::find($request->category)->name;
        }
        $data['categories'] = Category::get();
        $data['popular_books'] = Book::take(5)->get();
        return view('books.user_books', $data);
    }

    public function view_book($id, $user_info = null)
    {
        $data['data'] = Book::find($id);
        if ($user_info != null) {
            $data['books'] = IssuedBooks::with('user')->where('book_id', $id)->where('return_status', 'Issued')->get();
            return view('books.modal.view_status', $data);
        } else {
            return view('books.modal.user_book', $data);
        }
    }
}
