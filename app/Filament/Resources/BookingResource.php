<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make('Detail Booking')
                            ->schema([
                                Select::make('user_id')
                                    ->relationship('user', 'name')
                                    ->required()
                                    ->disabled(fn ($record) => $record !== null)
                                    ->columnSpan(1),
                                
                                Select::make('field_id')
                                    ->relationship('field', 'name')
                                    ->required()
                                    ->live()
                                    ->disabled(fn ($record) => $record !== null)
                                    ->afterStateUpdated(fn (Set $set, Get $get) => self::updateTotalPrice($set, $get))
                                    ->columnSpan(1),

                                DatePicker::make('start_time')
                                    ->label('Tanggal Booking')
                                    ->required()
                                    ->native(false)
                                    ->live()
                                    ->minDate(now()->startOfDay()) 
                                    ->disabled(fn ($record) => $record !== null)
                                    ->afterStateUpdated(fn (Set $set, Get $get) => self::updateTotalPrice($set, $get))
                                    ->columnSpan(1),

                                TimePicker::make('start_time_display')
                                    ->label('Jam Mulai')
                                    ->format('H:i')
                                    ->required()
                                    ->live()
                                    ->disabled(fn ($record) => $record !== null)
                                    ->dehydrated(true)
                                    ->afterStateHydrated(function ($component, $record) {
                                        if ($record && $record->start_time) {
                                            $component->state($record->start_time->format('H:i'));
                                        }
                                    })
                                    ->columnSpan(1),

                                Select::make('duration')
                                    ->label('Durasi (Jam)')
                                    ->options([
                                        1 => '1 Jam',
                                        2 => '2 Jam',
                                        3 => '3 Jam',
                                        4 => '4 Jam',
                                    ])
                                    ->default(1)
                                    ->required()
                                    ->live()
                                    ->dehydrated(false)
                                    ->disabled(fn ($record) => $record !== null)
                                    ->afterStateHydrated(function (Set $set, $record) {
                                        if ($record && $record->start_time && $record->end_time) {
                                            $set('duration', $record->start_time->diffInHours($record->end_time));
                                        }
                                    })
                                    ->afterStateUpdated(fn (Set $set, Get $get) => self::updateTotalPrice($set, $get))
                                    ->columnSpan(1),

                                TextInput::make('total_price')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required()
                                    ->readOnly()
                                    ->columnSpan(1),

                            ])->columns(2),

                        Section::make('Status & Catatan Admin')
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        'pending_verification' => 'Menunggu Verifikasi',
                                        'confirmed' => 'Dikonfirmasi',
                                        'rejected' => 'Ditolak',
                                        'cancelled' => 'Dibatalkan',
                                        'completed' => 'Selesai',
                                    ])->required(),
                                Textarea::make('admin_notes')->label('Catatan Admin')->rows(3),
                            ]),
                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Bukti Pembayaran')
                            ->schema([
                                FileUpload::make('payment_proof_path')
                                    ->label('Bukti Pembayaran')
                                    ->visible(fn ($record) => filled($record?->payment_proof_path))
                                    ->disabled()
                                    ->columnSpan('full'),
                            ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        // LOGIKA AUTO-UPDATE STATUS
        // Mencari booking yang sudah melewati end_time untuk diubah statusnya
        Booking::where('status', 'confirmed')
            ->where('end_time', '<', now())
            ->update(['status' => 'completed']);

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Pelanggan')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('field.name')->label('Lapangan')->sortable(),
                Tables\Columns\TextColumn::make('start_time')->label('Mulai')->dateTime('d/m/Y H:i')->sortable(),
                Tables\Columns\TextColumn::make('end_time')->label('Selesai')->dateTime('H:i')->sortable(),
                Tables\Columns\TextColumn::make('total_price')->label('Total')->money('IDR')->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending_verification' => 'warning',
                        'rejected' => 'danger',
                        'completed' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'completed' => 'Selesai digunakan',
                        'confirmed' => 'Dikonfirmasi',
                        'pending_verification' => 'Menunggu Verifikasi',
                        'rejected' => 'Ditolak',
                        'cancelled' => 'Dibatalkan',
                        default => $state,
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])
            ]);
    }

    public static function updateTotalPrice(Set $set, Get $get)
    {
        $fieldId = $get('field_id');
        $date = $get('start_time');
        $duration = (int) $get('duration') ?: 1;

        if ($fieldId && $date) {
            $carbonDate = Carbon::parse($date);
            $dayType = ($carbonDate->isWeekend()) ? 'weekend' : 'weekday';

            $priceSetting = DB::table('price_settings')
                ->where('field_id', $fieldId)
                ->where('day_type', $dayType)
                ->first();

            $pricePerHour = $priceSetting ? $priceSetting->price_per_hour : 0;
            $set('total_price', $pricePerHour * $duration);
        }
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