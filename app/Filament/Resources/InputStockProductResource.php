<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InputStockProductResource\Pages;
use App\Http\Controllers\InputStockProductController;
use App\Models\InputStock;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InputStockProductResource extends Resource
{
    protected static ?string $model = InputStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Produk')
                    ->options(Product::pluck('nama', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('penambahan_stok')
                    ->label('Penambahan Stok')
                    ->numeric()
                    ->required(),
                Forms\Components\DateTimePicker::make('tanggal_input')
                    ->label('Tanggal Input')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.nama')
                    ->label('Nama Produk')
                    ->searchable(),
                Tables\Columns\TextColumn::make('penambahan_stok')
                    ->label('Total Penambahan Stok')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_input')
                    ->label('Tanggal Input Stok')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('tanggal_input', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->visible(fn () => auth()->user()->role !== 'sales'), // Hide Edit action for sales role
            Tables\Actions\DeleteAction::make()
                ->visible(fn () => auth()->user()->role !== 'sales'), // Hide Delete action for sales role
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(fn (Collection $records) => $records->each(fn (InputStock $record) => (new InputStockProductController)->delete($record))),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInputStockProducts::route('/'),
            'create' => Pages\CreateInputStockProduct::route('/create'),
            'edit' => Pages\EditInputStockProduct::route('/{record}/edit'),
        ];
    }
}