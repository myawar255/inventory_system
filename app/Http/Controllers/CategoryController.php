<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
    }

    public function get_data()
    {
        $data = Category::select(['id', 'name', 'color']);
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $view_btn = $data->books->count() > 0 ? $this->viewButton($data->id, "View Books") : '';
                if ($data->books->count() == 0) {
                    $edit_delete_btn =  $this->edit_button($data->id) . $this->delete_button($data->id);
                } else {
                    $edit_delete_btn = $this->edit_button($data->id);
                }
                return $view_btn . $edit_delete_btn;
            })
            ->addColumn('bg_color', function ($data) {
                return '<span class="badge" style="background:' . $data->background . '">&nbsp;&nbsp;</span>';
            })
            ->rawColumns(['action', 'bg_color'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.modal.add');
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
                'name' => 'required|unique:categories,name',
                'image' => 'image|max:2048' // validate that the uploaded file is an image and its size is less than or equal to 2MB
            ],
        );
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 500);
        }

        $data = new Category();
        $data->name = $request->name;
        $data->color = $request->color;

        if ($request->hasFile('image')) {
            $slug = Str::slug($request->name);
            $image = $request->file('image');
            $randomString = Str::random(5);
            $imageName = $slug . '_' . $randomString . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/category/images', $imageName);
            $data->image = $imageName;
        }
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
        $data = Category::find($id);
        return view('category.modal.edit', compact('data'));
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
                'image' => 'nullable|image|max:2048' // validate that the uploaded file is an image and its size is less than or equal to 2MB
            ],
        );
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 500);
        }

        $data = Category::find($id);
        $data->name = $request->name;
        $data->color = $request->color;

        $slug = Str::slug($request->name);
        if ($request->hasFile('image')) {
            //check for old image file
            $imagePath = 'public/category/images/' . $data->image;

            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            //save image file
            $image = $request->file('image');
            $randomString = Str::random(5);
            $imageName = $slug . '_' . $randomString . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/category/images', $imageName);
            $data->image = $imageName;
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
        $data = Category::findOrFail($id);
        $imagePath = 'public/category/images/' . $data->image;

        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        $data->delete();
        return 'Category Deleted Successfully';
    }


    public function user_categories(Request $request)
    {
        if ($request->name) {
            $data['categories'] = Category::where('name', 'LIKE', '%' . $request->name . '%')->get();
            $data['search_string'] = $request->name;
        } else {
            $data['categories'] = Category::get();
        }
        $data['popular_books'] = Book::take(5)->get();
        return view('category.user_categories', $data);
    }
}
