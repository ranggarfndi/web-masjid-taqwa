<?php

namespace App\Filament\Resources\PrayerSchedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PrayerSchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Tanggal
                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                // Waktu Sholat
                TextColumn::make('subuh')->label('Subuh'),
                
                // Logika Dzuhur vs Jumat (Penting!)
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
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
