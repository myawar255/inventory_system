<?php

namespace App\Http\Controllers;

use App\OrderedProduts;
use App\Orders;
use App\Products;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order_management.index');
    }
    public function get_data(Request $request)
    {
        $prducts = Orders::orderBy('id', 'desc')->get();
        return DataTables::of($prducts)
            ->addColumn('action', function ($product) {
                return $this->get_buttons($product->id);
            })
            ->addColumn('order_number', function ($product) {
                return 'Or' . $product->id;
            })
            ->addColumn('status', function ($product) {
                if ($product->status==0) {
                    $status='<p style="color: red">Pending</p>';
                    return $status;
                }else {
                    $status='<p style="color: green">Delievered</p>';
                    return $status;
                }
            })
            ->rawColumns(['status','order_number','action'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Products::get();
        return view('order_management.modal.add', compact('products'));
    }

    public function get_more_products($count=null)
    {
        $products = Products::get();
        return view('order_management.modal.add_more_products',compact('products','count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order=new Orders();
        $order->company_name=$request->company_name;
        $order->delivery=$request->deleivery_date;
        $order->order_date=$request->order_date;
        $order->save();
        $ordered_product=new OrderedProduts();
        $ordered_product->order_id=$order->id;
        $ordered_product->product_id=$order->product_name;
        $ordered_product->save();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
