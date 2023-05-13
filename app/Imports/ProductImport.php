<?php

namespace App\Imports;

use App\Products;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements ToCollection
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
                    $product = new Products();
                    $product->userid = auth()->id();
                    $product->productname = $row[0] ?? null;
                    $product->stock = $row[1] ?? null;
                    $product->purchase_price = $row[2] ?? null;
                    $product->sale_price = $row[3] ?? null;
                    // dd($row[3]);
                    $product->save();
                } catch (\Throwable $th) {
                    continue;
                }
            }
        }
    }
}
