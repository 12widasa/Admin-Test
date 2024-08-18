<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\ManagementProductResource\RelationManagers;

use App\Models\User;
use App\Models\City; // Import the City model
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Menambahkan kondisi untuk menyembunyikan resource berdasarkan peran user


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama'),
                FileUpload::make('foto')
                    ->image()
                    ->label('Foto'),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->label('Kata Sandi'),
                DatePicker::make('tanggal_lahir')
                    ->required()
                    ->label('Tanggal Lahir'),
                Select::make('kota_asal')
                    ->label('Asal Kota')
                    ->options(City::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Select::make('role')
                    ->required()
                    ->options([
                        'superadmin' => 'Super Admin',
                        'admin_create' => 'Admin Create',
                        'admin_view' => 'Admin View',
                        'sales' => 'Sales',
                    ])
                    ->label('Role'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->label('Nama'),
            Tables\Columns\ImageColumn::make('foto')
                ->circular()
                ->label('Foto'),
            Tables\Columns\TextColumn::make('email')
                ->searchable(),
            Tables\Columns\TextColumn::make('tanggal_lahir')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('role')
                ->searchable(),
            Tables\Columns\TextColumn::make('city.name')
                ->label('Asal Kota')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            Tables\Filters\Filter::make('name')
                ->form([
                    Forms\Components\TextInput::make('name')->label('Nama'),
                ])
                ->query(fn (Builder $query, array $data): Builder => 
                    isset($data['name']) && $data['name'] !== '' 
                    ? $query->where('name', 'like', '%' . $data['name'] . '%')
                    : $query
                ),
            Tables\Filters\Filter::make('tanggal_lahir')
                ->form([
                    Forms\Components\DatePicker::make('tanggal_lahir')->label('Tanggal Lahir'),
                ])
                ->query(fn (Builder $query, array $data): Builder => 
                    isset($data['tanggal_lahir']) && $data['tanggal_lahir'] !== null 
                    ? $query->whereDate('tanggal_lahir', '=', $data['tanggal_lahir'])
                    : $query
                ),
            Tables\Filters\SelectFilter::make('role')
                ->options([
                    'admin_create' => 'Admin Create',
                    'admin_view' => 'Admin View',
                    'sales' => 'Sales',
                ])
                ->label('Role'),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
