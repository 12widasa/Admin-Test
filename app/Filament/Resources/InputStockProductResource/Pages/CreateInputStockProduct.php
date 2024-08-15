<?php

namespace App\Filament\Resources\InputStockProductResource\Pages;

use App\Filament\Resources\InputStockProductResource;
use App\Http\Controllers\InputStockProductController;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateInputStockProduct extends CreateRecord
{
    protected static string $resource = InputStockProductResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return app(InputStockProductController::class)->create($data);
    }
        protected function canCreate(): bool
{
    return auth()->user()->can('createProduct', User::class);
}
}