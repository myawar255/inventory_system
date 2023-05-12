<?php

namespace App\Exports;

use App\Customers;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomersExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

        public function query()
    {
        return Customers::query()->select('customer_name','customer_address','customer_phone')->where('user_id', auth()->id());
    }

    public function map($t): array
    {
        return [
            $t->customer_name,
            $t->customer_address,
            $t->customer_phone,
        ];
    }

    public function headings(): array
    {
        return ['name', 'address', 'phone'];
    }
    }

