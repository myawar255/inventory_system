<?php

namespace App\Imports;

use App\Customers;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CustomersImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            // dd($key);
            if ($key == 0) {
                continue;
            } else {
                try {
                    $customer = new Customers();
                    $customer->user_id = auth()->id();
                    $customer->customer_name = $row[0] ?? null;
                    $customer->customer_address = $row[1] ?? null;
                    $customer->customer_phone = $row[2] ?? null;
                    // dd($row[2]);
                    $customer->save();
                } catch (\Throwable $th) {
                    continue;
                }
            }
        }
    }
}
