<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Database\Eloquent\Builder;

class ProductExport implements FromQuery, WithHeadings
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query->select('nama', 'stok_sekarang');
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Stok Produk',
            // produk terjual
        ];
    }
}