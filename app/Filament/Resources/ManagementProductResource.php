<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ManagementProductResource\Pages;
use App\Filament\Resources\ManagementProductResource\RelationManagers;
use App\Models\User;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManagementProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->label('Nama Produk'),

                Forms\Components\FileUpload::make('foto')
                    ->required()
                    ->label('Foto Produk'),

                Forms\Components\TextInput::make('stok')
                    ->numeric()
                    ->label('Stok Produk'),

                Forms\Components\TextInput::make('total_penjualan')
                    ->numeric()
                    ->label('Total Penjualan Produk'),
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('nama')
                ->sortable()
                ->searchable()
                ->label('Nama Produk'),

            Tables\Columns\ImageColumn::make('foto')
                ->label('Foto Produk'),
        ])
        ->filters([
            Tables\Filters\Filter::make('nama')
                ->form([
                    Forms\Components\TextInput::make('nama')
                        ->label('Nama Produk'),
                ])
                ->query(fn (Builder $query, array $data): Builder => 
                    isset($data['nama']) && $data['nama'] !== '' 
                    ? $query->where('nama', 'like', '%' . $data['nama'] . '%')
                    : $query
                ),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make()
                ->visible(fn () => auth()->user()->role !== 'sales'), // Hide Edit action for sales role
            Tables\Actions\DeleteAction::make()
                ->visible(fn () => auth()->user()->role !== 'sales'), // Hide Delete action for sales role
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListManagementProducts::route('/'),
            'create' => Pages\CreateManagementProduct::route('/create'),
            'edit' => Pages\EditManagementProduct::route('/{record}/edit'),
        ];
    }
}
