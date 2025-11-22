<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PriceSettingResource\Pages;
use App\Models\PriceSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PriceSettingResource extends Resource
{
    protected static ?string $model = PriceSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pengaturan Harga';
    protected static ?string $pluralLabel = 'Pengaturan Harga Lapangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('field_id')
                    ->label('Nama Lapangan')
                    ->relationship('field', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('day_type')
                    ->label('Jenis Hari')
                    ->options([
                        'weekday' => 'Weekday',
                        'weekend' => 'Weekend',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('price_per_hour')
                    ->label('Harga per Jam')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Forms\Components\TimePicker::make('start_time')
                    ->label('Waktu Mulai')
                    ->required(),

                Forms\Components\TimePicker::make('end_time')
                    ->label('Waktu Selesai')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('field.name')
                    ->label('Nama Lapangan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('day_type')
                    ->label('Jenis Hari')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_per_hour')
                    ->label('Harga / Jam')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_time')
                    ->label('Mulai')
                    ->time('H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_time')
                    ->label('Selesai')
                    ->time('H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPriceSettings::route('/'),
            'create' => Pages\CreatePriceSetting::route('/create'),
            'edit'   => Pages\EditPriceSetting::route('/{record}/edit'),
        ];
    }
}
