<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormSalesResource\Pages;
use App\Filament\Resources\FormSalesResource\RelationManagers;
use App\Models\FormSales;
use App\Models\Product;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormSalesResource extends Resource
{
    protected static ?string $model = FormSales::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product')
                    ->options(Product::pluck('nama', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('stok_terjual')
                    ->label('Stok Terjual')
                    ->numeric()
                    ->required()
                    ->minValue(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.nama')->label('Product'),
                Tables\Columns\TextColumn::make('user.name')->label('Sales'),
                Tables\Columns\TextColumn::make('stok_terjual')->label('Stok Terjual'),
                Tables\Columns\TextColumn::make('tanggal_input')->label('Tanggal Input')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListFormSales::route('/'),
            'create' => Pages\CreateFormSales::route('/create'),
            'edit' => Pages\EditFormSales::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return Auth::user()->role === User::ROLE_SALES;
    }

    // public static function canEdit(FormSales $record): bool
    // {
    //     return false; // Disable editing
    // }

    // public static function canDelete(FormSales $record): bool
    // {
    //     return false; // Disable deleting
    // }
}