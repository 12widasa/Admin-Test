<?php

namespace App\Filament\Resources\ListRoleResource\Pages;

use App\Filament\Resources\ListRoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListListRoles extends ListRecords
{
    protected static string $resource = ListRoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
