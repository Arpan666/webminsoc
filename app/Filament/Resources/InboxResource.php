<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InboxResource\Pages;
use App\Models\Inbox;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InboxResource extends Resource
{
    protected static ?string $model = Inbox::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';
    protected static ?string $navigationLabel = 'Inbox Pesan';
    protected static ?string $pluralLabel = 'Inbox Pesan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Pengirim')
                    ->disabled(),
                Forms\Components\TextInput::make('email')
                    ->label('Alamat Email')
                    ->disabled(),
                Forms\Components\Textarea::make('message')
                    ->label('Isi Pesan')
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Pengirim')
                    ->searchable()
                    // LOGIKA BARU: Teks tebal jika belum dibaca, normal jika sudah
                    ->weight(fn ($record) => $record->is_read ? 'normal' : 'bold')
                    // LOGIKA BARU: Teks jadi ABU-ABU jika sudah dibaca
                    ->color(fn ($record) => $record->is_read ? 'gray' : null),
                
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->copyable()
                    // Ikut jadi abu-abu jika sudah dibaca
                    ->color(fn ($record) => $record->is_read ? 'gray' : null),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    // Ikut jadi abu-abu jika sudah dibaca
                    ->color(fn ($record) => $record->is_read ? 'gray' : null),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Baca Pesan')
                    ->color('info')
                    ->mutateRecordDataUsing(function (array $data, $record) {
                        // Tandai sudah dibaca saat modal dibuka
                        $record->update(['is_read' => true]);
                        return $data;
                    })
                    // Tombol Balas di dalam modal samping tombol Close
                    ->extraModalFooterActions([
                        Tables\Actions\Action::make('reply_gmail')
                            ->label('Balas via Gmail')
                            ->icon('heroicon-o-envelope')
                            ->color('success')
                            ->url(function ($record) {
                                $baseUrl = "https://mail.google.com/mail/?view=cm&fs=1";
                                $to = "&to=" . $record->email;
                                $subject = "&su=" . urlencode("Balasan Pesan F9 Minisoccer");
                                $bodyText = "Halo " . $record->name . ",\n\nTerima kasih telah menghubungi F9 Minisoccer.\n\nMembalas pesan Anda: \"" . $record->message . "\"\n\n---\nJawaban Admin:";
                                return $baseUrl . $to . $subject . "&body=" . urlencode($bodyText);
                            })
                            ->openUrlInNewTab(),
                    ])
                    // Refresh halaman setelah modal ditutup agar badge & warna terupdate
                    ->after(function () {
                        return redirect(static::getUrl('index'));
                    }),

                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        // Menghitung jumlah pesan yang belum dibaca untuk badge
        $count = static::getModel()::where('is_read', false)->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInboxes::route('/'),
        ];
    }
}