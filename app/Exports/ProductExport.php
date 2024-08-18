<?php

// namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromQuery;
// use Maatwebsite\Excel\Concerns\WithHeadings;
// use Illuminate\Database\Eloquent\Builder;

// class ProductExport implements FromQuery, WithHeadings
// {
//     protected $query;

//     public function __construct(Builder $query)
//     {
//         $this->query = $query;
//     }

//     public function query()
//     {
//         return $this->query->select('nama', 'stok_sekarang');
//     }

//     public function headings(): array
//     {
//         return [
//             'Nama',
//             'Stok Produk',
//             // produk terjual
//         ];
//     }
// }

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromQuery, WithHeadings, WithMapping
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query->with('formSales');
    }

    public function map($product): array
    {
        return [
            $product->nama,
            $product->stok_sekarang,
            $product->total_penjualan,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Stok Produk',
            'Total Penjualan',
        ];
    }
}