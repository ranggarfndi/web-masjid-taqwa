<?php

namespace App\Filament\Resources\PrayerSchedules\Tables;

use App\Models\PrayerSchedule;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
// 1. Tambahkan Import ReplicateAction
use Filament\Actions\EditAction;
use Filament\Actions\ReplicateAction;
use Filament\Forms\Components\DatePicker; // Import DatePicker untuk form popup
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PrayerSchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('subuh')->label('Subuh'),
                
                TextColumn::make('dzuhur')
                    ->label('Dzuhur / Jumat')
                    ->state(function ($record) {
                        return $record->is_friday 
                            ? $record->waktu_jumat . ' (Jumat)' 
                            : $record->dzuhur;
                    }),

                TextColumn::make('ashar')->label('Ashar'),
                TextColumn::make('maghrib')->label('Maghrib'),
                TextColumn::make('isya')->label('Isya'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),

                // --- 2. TAMBAHKAN KODE INI ---
                ReplicateAction::make()
                    ->label('Duplikat') // Label tombol
                    ->color('success')  // Warna hijau
                    ->icon('heroicon-o-document-duplicate')
                    ->modalHeading('Duplikat Jadwal Sholat')
                    ->modalDescription('Salin jam sholat ini ke tanggal lain.')
                    ->excludeAttributes(['date']) // JANGAN copy tanggal lama (karena tanggal harus unik)
                    ->form([
                        // Munculkan Form kecil meminta tanggal baru
                        DatePicker::make('date')
                            ->label('Jadwal Untuk Tanggal')
                            ->required()
                            ->unique('prayer_schedules', 'date') // Cek agar tidak bentrok
                            ->default(now()->addDay()), // Default otomatis terisi 'Besok'
                    ])
                    ->beforeReplicaSaved(function (PrayerSchedule $replica, array $data) {
                        // Simpan tanggal baru yang dipilih user ke data hasil copy
                        $replica->date = $data['date'];
                    }),
                // -----------------------------

                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}