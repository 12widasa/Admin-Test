<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListRoleResource\Pages;
use App\Filament\Resources\ListRoleResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;


class ListRoleResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'List Role';

        public static function shouldRegisterNavigation(): bool
    {
        // Hanya tampilkan halaman ini jika bukan "sales"
        return Auth::user()->role !== 'sales';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('role')
                    ->label('Nama Role')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListRoles::route('/'),
            'create' => Pages\CreateListRole::route('/create'),
            'edit' => Pages\EditListRole::route('/{record}/edit'),
        ];
    }
}
