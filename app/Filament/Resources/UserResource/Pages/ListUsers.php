<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
{
    return [
        Actions\CreateAction::make()->visible(auth()->user()->can('create', User::class)),
        Actions\Action::make('export')
            ->label('Export XLSX')
            ->icon('heroicon-o-document-arrow-down')
            ->url(fn () => url('/export/users?' . urldecode(request()->getQueryString())))
            ->openUrlInNewTab(),
    ];
}

}