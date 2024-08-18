<?php

namespace App\Filament\Resources\ManagementProductResource\Pages;

use App\Filament\Resources\ManagementProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth; 

class ListManagementProducts extends ListRecords
{
    protected static string $resource = ManagementProductResource::class;

    protected function getHeaderActions(): array
    {
        $decodeQueryString = urldecode(request()->getQueryString());

       return [
        Actions\CreateAction::make(),
        // Actions\CreateAction::make()->visible(auth()->user()->can('createProduct', User::class)),
        Actions\Action::make('export')
            ->label('Export XLSX')
            ->icon('heroicon-o-document-arrow-down')
            ->url(fn () => url('/export/products?' . urldecode(request()->getQueryString())))
            ->openUrlInNewTab(),
    ];
    }
}