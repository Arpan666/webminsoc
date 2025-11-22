<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

// app/Filament/Resources/BookingResource.php (Method table)
public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('user.name')
                ->label('Pelanggan')
                ->searchable(),
            Tables\Columns\TextColumn::make('field.name')
                ->label('Lapangan')
                ->searchable(),
            Tables\Columns\TextColumn::make('start_time')
                ->dateTime()
                ->sortable(),
            Tables\Columns\TextColumn::make('total_price')
                ->money('IDR')
                ->sortable(),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending_verification' => 'warning',
                    'confirmed' => 'success',
                    'rejected' => 'danger',
                    'completed' => 'primary',
                })
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        // ... (sisanya biarkan default)
        ->actions([
            Tables\Actions\EditAction::make(),
        ]);
}

// Tambahkan form untuk EditAction (Method form)
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->disabled(), // Tidak boleh diubah Admin
                Forms\Components\Select::make('field_id')
                    ->relationship('field', 'name')
                    ->required()
                    ->disabled(), // Tidak boleh diubah Admin
                Forms\Components\DateTimePicker::make('start_time')
                    ->required()
                    ->disabled(), // Tidak boleh diubah Admin
                Forms\Components\TextInput::make('total_price')
                    ->required()
                    ->disabled(), // Tidak boleh diubah Admin
                Forms\Components\Select::make('status')
                    ->options([
                        'pending_verification' => 'Menunggu Verifikasi',
                        'confirmed' => 'Dikonfirmasi',
                        'rejected' => 'Ditolak',
                        'completed' => 'Selesai',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('admin_notes')
                    ->label('Catatan Admin')
                    ->maxLength(255),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
