<?php

namespace App\Exports;

use App\Products;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

        public function query()
    {
        return Products::query()->select('productname','stock','purchase_price','sale_price');
    }

    public function map($t): array
    {
        return [
            $t->productname,
            $t->stock,
            $t->purchase_price,
            $t->sale_price,
        ];
    }

    public function headings(): array
    {
        return ['name', 'stock', 'purchase price','sale price'];
    }
}
