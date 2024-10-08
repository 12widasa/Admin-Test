<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Database\Eloquent\Builder;

class UsersExport implements FromQuery, WithHeadings
{
    protected $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query->select('name', 'email', 'tanggal_lahir', 'kota_asal');
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Tanggal Lahir',
            'Kota Asal',
        ];
    }
}