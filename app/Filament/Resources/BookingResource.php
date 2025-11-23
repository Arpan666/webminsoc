<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms\Form;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    // ----------------------------------------------------------------------
    // TABLE DEFINITION (List Bookings)
    // ----------------------------------------------------------------------
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('field.name')
                    ->label('Lapangan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Waktu Booking')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state)))
                    ->color(fn (string $state): string => match ($state) {
                        'pending_verification' => 'warning',
                        'waiting_confirmation' => 'info',
                        'confirmed' => 'success',
                        'rejected' => 'danger',
                        'cancelled' => 'gray',
                        'completed' => 'primary',
                        default => 'secondary',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Dibuat Pada')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(), // Tombol Delete
            ]);
    }

    // ----------------------------------------------------------------------
    // FORM DEFINITION (Create/Edit Booking)
    // ----------------------------------------------------------------------
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Group Kiri (Detail Booking & Status)
                Group::make()
                    ->schema([
                        Section::make('Detail Booking')
                            ->schema([
                                Select::make('user_id')
                                    ->relationship('user', 'name')
                                    ->required()
                                    ->disabled()
                                    ->columnSpan(1),
                                Select::make('field_id')
                                    ->relationship('field', 'name')
                                    ->required()
                                    ->disabled()
                                    ->columnSpan(1),
                                TextInput::make('total_price')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required()
                                    ->disabled()
                                    ->columnSpan(1),
                                DatePicker::make('start_time')
                                    ->label('Tanggal Booking')
                                    ->required()
                                    ->disabled()
                                    ->columnSpan(1),
                                TimePicker::make('start_time_display')
                                    ->label('Jam Mulai')
                                    ->format('H:i')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->afterStateHydrated(function ($component, $record) {
                                        if ($record && $record->start_time) {
                                            $component->state($record->start_time->format('H:i'));
                                        }
                                    })
                                    ->columnSpan(1),
                            ])->columns(2),

                        Section::make('Status & Catatan Admin')
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        'pending_verification' => 'Menunggu Verifikasi Pembayaran',
                                        'confirmed' => 'Dikonfirmasi (Pembayaran OK)',
                                        'rejected' => 'Ditolak',
                                        'cancelled' => 'Dibatalkan Pelanggan',
                                        'completed' => 'Selesai (Sudah Digunakan)',
                                    ])
                                    ->required()
                                    ->label('Ubah Status'),
                                
                                Textarea::make('admin_notes')
                                    ->label('Catatan Admin')
                                    ->placeholder('Tambahkan alasan penolakan atau keterangan penting.')
                                    ->rows(3)
                                    ->columnSpan('full'),
                            ])->columns(1),
                    ])->columnSpan(2),

                // Group Kanan (Bukti Pembayaran)
                Group::make()
                    ->schema([
                        Section::make('Bukti Pembayaran')
                            ->schema([
                                FileUpload::make('payment_proof_path') 
                                    ->label('Bukti Pembayaran Customer')
                                    ->image()
                                    ->directory('payment_proofs') 
                                    ->downloadable()
                                    ->imagePreviewHeight('200')
                                    ->visible(fn ($record) => filled($record->payment_proof_path)) 
                                    ->helperText(fn ($record) => $record->payment_proof_path ? 'Bukti pembayaran diunggah oleh customer.' : 'Belum ada bukti pembayaran.')
                                    ->maxSize(2048)
                                    ->columnSpan('full')
                                    ->disabled(),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function getRelations(): array
    {
        return [];
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
