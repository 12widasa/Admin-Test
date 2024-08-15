<?php

namespace App\Filament\Resources\InputStockProductResource\Pages;

use App\Filament\Resources\InputStockProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInputStockProducts extends ListRecords
{
    protected static string $resource = InputStockProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->visible(auth()->user()->can('create', User::class)),
        ];
    }
}
