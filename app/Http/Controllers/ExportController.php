<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\ProductExport;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportUsers(Request $request) 
    {
        $query = User::query();
        $this->applyFilters($query, $request);
        return Excel::download(new UsersExport($query), 'users.xlsx');
    }

    public function exportProducts(Request $request) 
    {
        $query = Product::query();
        $this->applyFilters($query, $request);
        return Excel::download(new ProductExport($query), 'products.xlsx');
    }

    private function applyFilters($query, Request $request) 
    {
        if ($request->has('filter')) {
            $filters = $request->filter;
            foreach ($filters as $field => $value) {
                $query->where($field, 'like', "%$value%");
            }
        }
    }
}