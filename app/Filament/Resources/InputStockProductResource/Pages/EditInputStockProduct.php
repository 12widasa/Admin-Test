<?php

namespace App\Filament\Resources\InputStockProductResource\Pages;

use App\Filament\Resources\InputStockProductResource;
use App\Http\Controllers\InputStockProductController;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditInputStockProduct extends EditRecord
{
    protected static string $resource = InputStockProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->action(fn () => app(InputStockProductController::class)->delete($this->record)),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return app(InputStockProductController::class)->update($record, $data);
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