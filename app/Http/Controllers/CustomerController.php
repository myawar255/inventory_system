<?php

namespace App\Http\Controllers;

use App\Customers;
use App\Exports\CustomersExport;
use Illuminate\Contracts\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index');
    }

    public function get_data(Request $request)
    {
        $prducts = Customers::orderBy('id', 'desc')->get();
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
        return view('customers.modal.add');
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
                'name' => 'required',
                'address' => 'required',
                'phone' => 'required',
            ],
        );
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 500);
        }
        $customer = new Customers();
        $customer->customer_name = $request->name;
        $customer->customer_address = $request->address;
        $customer->customer_phone = $request->phone;
        $customer->comment = $request->comment;
        $customer->save();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customers::find($id);
        return view('customers.modal.edit', compact('customer'));
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
        $customer = Customers::find($request->id);
        $customer->customer_name = $request->name;
        $customer->customer_address = $request->address;
        $customer->customer_phone = $request->phone;
        $customer->comment = $request->comment;
        $customer->save();

        return 'Customer Updated Successfully';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $agent = Customers::find($id);
        $agent->delete();
        return 'Customer Deleted Succesfully';
    }

    public function export_customers()
    {
        return Excel::download(new CustomersExport, 'customers.csv');
        return redirect()->back();
    }
}
