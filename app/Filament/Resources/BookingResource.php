<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\PriceSetting;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Pesanan')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Pelanggan')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('field_id')
                            ->relationship('field', 'name')
                            ->label('Lapangan')
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),

                        DatePicker::make('booking_date')
                            ->label('Tanggal')
                            ->required()
                            ->native(false)
                            ->minDate(now()->startOfDay())
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),

                        TimePicker::make('booking_time')
                            ->label('Jam Mulai')
                            ->required()
                            ->native(false)
                            ->live()
                            ->rules([
                                fn (Get $get): \Closure => function (string $attribute, $value, \Closure $fail) use ($get) {
                                    $dateRaw = $get('booking_date');
                                    $fieldId = $get('field_id');
                                    $duration = (int) ($get('duration') ?? 1);
                                    
                                    if (!$dateRaw || !$fieldId || !$value) return;

                                    try {
                                        $d = Carbon::parse($dateRaw)->format('Y-m-d');
                                        $t = Carbon::parse($value)->format('H:i:s');
                                        $start = Carbon::parse($d . ' ' . $t);
                                        $end = $start->copy()->addHours($duration);

                                        if ($start->isPast()) {
                                            $fail('Jam sudah lewat, Bos!');
                                            return;
                                        }

                                        $isBooked = Booking::where('field_id', $fieldId)
                                            ->whereIn('status', ['confirmed', 'pending_verification'])
                                            ->where(function ($q) use ($start, $end) {
                                                $q->where('start_time', '<', $end)
                                                  ->where('end_time', '>', $start);
                                            })
                                            ->when($get('id'), fn($q, $id) => $q->where('id', '!=', $id))
                                            ->exists();

                                        if ($isBooked) $fail('Jadwal bentrok! Lapangan sudah dipesan.');
                                    } catch (\Exception $e) { return; }
                                },
                            ]),

                        Select::make('duration')
                            ->label('Durasi')
                            ->options([1 => '1 Jam', 2 => '2 Jam', 3 => '3 Jam'])
                            ->default(1)
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),

                        TextInput::make('total_price')
                            ->label('Total Harga')
                            ->prefix('Rp')
                            ->readonly()
                            ->required(),

                        Select::make('status')
                            ->options([
                                'pending_verification' => 'Pending',
                                'confirmed' => 'Lunas',
                                'cancelled' => 'Batal',
                            ])->default('confirmed')->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User')->sortable(),
                Tables\Columns\TextColumn::make('field.name')->label('Lapangan')->badge(),
                Tables\Columns\TextColumn::make('start_time')->label('Mulai')->dateTime('d M H:i'),
                Tables\Columns\TextColumn::make('total_price')->label('Total')->money('IDR'),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending_verification' => 'warning',
                        default => 'danger',
                    }),
            ])
            ->defaultSort('start_time', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    protected static function updateTotalPrice(Get $get, Set $set): void
    {
        $fieldId = $get('field_id');
        $date = $get('booking_date');
        $duration = (int) $get('duration');

        if ($fieldId && $date) {
            $isWeekend = Carbon::parse($date)->isWeekend();
            $price = PriceSetting::where('field_id', $fieldId)
                ->where('day_type', $isWeekend ? 'weekend' : 'weekday')
                ->first()?->price_per_hour ?? 0;
            $set('total_price', $price * $duration);
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