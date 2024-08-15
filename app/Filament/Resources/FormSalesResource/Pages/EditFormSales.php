<?php

namespace App\Filament\Resources\FormSalesResource\Pages;

use App\Filament\Resources\FormSalesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormSales extends EditRecord
{
    protected static string $resource = FormSalesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
