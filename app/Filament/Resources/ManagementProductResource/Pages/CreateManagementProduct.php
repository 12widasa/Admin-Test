<?php

namespace App\Filament\Resources\ManagementProductResource\Pages;

use App\Filament\Resources\ManagementProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateManagementProduct extends CreateRecord
{
    protected static string $resource = ManagementProductResource::class;
    
    protected function canCreate(): bool
{
    return auth()->user()->can('createProduct', User::class);
}

}
