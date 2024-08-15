<?php

namespace App\Filament\Widgets;

use App\Models\FormSales;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class TodaySalesWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $todaySales = FormSales::whereDate('tanggal_input', today())
            ->select(DB::raw('SUM(stok_terjual) as total_sold'), DB::raw('COUNT(DISTINCT user_id) as total_sales'))
            ->first();

        return [
            Stat::make('Total Produk Terjual Hari Ini', $todaySales->total_sold ?? 0)
                ->description('Dari ' . ($todaySales->total_sales ?? 0) . ' sales')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->icon('heroicon-o-shopping-bag'),
        ];
    }
}