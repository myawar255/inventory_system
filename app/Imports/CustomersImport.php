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
            if ($key == 0) {
                continue;
            } else {
                try {
                    $expenditure = new Customers();
                    $expenditure->user_id = auth()->id();
                    $expenditure->amount = $row[0] ?? null;
                    $expenditure->description = $row[1] ?? null;
                    $expenditure->dt = strtotime($row[2]) ?? null;
                    $expenditure->save();
                } catch (\Throwable $th) {
                    continue;
                }
            }
        }
    }
}
