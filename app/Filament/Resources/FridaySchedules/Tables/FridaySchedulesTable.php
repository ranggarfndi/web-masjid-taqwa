<?php

namespace App\Filament\Resources\FridaySchedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction; // Saya tambahkan DeleteAction biar bisa hapus satu-satu
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class FridaySchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Tanggal
                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d F Y')
                    ->sortable(),

                // Jam
                TextColumn::make('waktu')
                    ->label('Jam')
                    ->time('H:i'),

                // Khatib
                TextColumn::make('khatib')
                    ->label('Khatib')
                    ->searchable(),

                // Imam
                TextColumn::make('imam')
                    ->label('Imam')
                    ->placeholder('-'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}