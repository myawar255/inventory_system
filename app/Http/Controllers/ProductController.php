<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }

    public function get_data(Request $request)
    {
        $prducts = Products::orderBy('id', 'desc')->get();
        return DataTables::of($prducts)
            ->addColumn('action', function ($product) {
                return $this->get_buttons($product->id);
            })

            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.modal.add');
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
                'productname' => 'required',
                'purchase_price' => 'required',
                'opening_stock' => 'required',
            ],
        );
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 500);
        }
        $product = new Products();
        $product->productname = $request->productname;
        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->sale_price;
        $product->opening_stock = $request->opening_stock;
        $product->save();
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
        $product = Products::find($id);
        return view('products.modal.edit', compact('product'));
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
                'productname' => 'required',
                'purchase_price' => 'required',
                'opening_stock' => 'required',
            ],
        );
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 500);
        }
        $product = Products::find($request->id);
        $product->productname = $request->productname;
        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->sale_price;
        $product->opening_stock = $request->opening_stock;
        $product->save();
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
        $agent = Products::find($id);
        $agent->delete();
        return 'Product Deleted Succesfully';
    }

    public function export_products()
    {
        return Excel::download(new ProductExport, 'customers.csv');
        return redirect()->back();
    }
    public function import_products(Request $request)
    {
        Excel::import(new ProductImport, $request->csv_file);

        return redirect()->back();;
    }
}
