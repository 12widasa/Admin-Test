<?php

namespace App\Filament\Resources\ListRoleResource\Pages;

use App\Filament\Resources\ListRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditListRole extends EditRecord
{
    protected static string $resource = ListRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
