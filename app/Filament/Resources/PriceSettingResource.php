<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PriceSettingResource\Pages;
use App\Filament\Resources\PriceSettingResource\RelationManagers;
use App\Models\PriceSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PriceSettingResource extends Resource
{
    protected static ?string $model = PriceSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

// app/Filament/Resources/PriceSettingResource.php (Hanya bagian form)

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('field_id')
                    ->relationship('field', 'name')
                    ->required(),
                Forms\Components\Select::make('day_type')
                    ->options([
                        'weekday' => 'Hari Kerja (Senin-Jumat)',
                        'weekend' => 'Akhir Pekan (Sabtu-Minggu)',
                    ])->required(),
                Forms\Components\TimePicker::make('start_time')->required(),
                Forms\Components\TimePicker::make('end_time')->required(),
                Forms\Components\TextInput::make('price_per_hour')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPriceSettings::route('/'),
            'create' => Pages\CreatePriceSetting::route('/create'),
            'edit' => Pages\EditPriceSetting::route('/{record}/edit'),
        ];
    }
}
