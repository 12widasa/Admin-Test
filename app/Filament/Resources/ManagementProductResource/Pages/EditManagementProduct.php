<?php

namespace App\Filament\Resources\ManagementProductResource\Pages;

use App\Filament\Resources\ManagementProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditManagementProduct extends EditRecord
{
    protected static string $resource = ManagementProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function canEdit(): bool
{
    return auth()->user()->can('updateProduct', $this->record);
}

protected function canDelete(): bool
{
    return auth()->user()->can('deleteProduct', $this->record);
}

}
