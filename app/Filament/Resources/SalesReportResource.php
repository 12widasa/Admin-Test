<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalesReportResource\Pages;
use App\Models\FormSales;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class SalesReportResource extends Resource
{
    protected static ?string $model = FormSales::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Sales Report';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form fields jika diperlukan
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Sales')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.nama')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stok_terjual')
                    ->label('Nominal Penjualan Produk')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_input')
                    ->label('Tanggal Input')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name')
                    ->label('Sales'),
                Tables\Filters\SelectFilter::make('product')
                    ->relationship('product', 'nama')
                    ->label('Produk'),
                Tables\Filters\Filter::make('tanggal_input')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_input')->label('Tanggal Input'),
                    ])
                    ->query(fn (Builder $query, array $data): Builder => 
                        isset($data['tanggal_input']) && $data['tanggal_input'] !== null 
                        ? $query->whereDate('tanggal_input', '=', $data['tanggal_input'])
                        : $query
                    ),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListSalesReports::route('/'),
        ];
    }

    // 
        public static function canViewAny(): bool
    {
        // Izinkan hanya user dengan peran 'sales'
        return true;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['user', 'product']);
    }
}