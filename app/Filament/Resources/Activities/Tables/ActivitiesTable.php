<?php

namespace App\Filament\Resources\Activities\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ActivitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Menampilkan Gambar
                ImageColumn::make('image')
                    ->label('Foto')
                    ->square(),

                // Menampilkan Judul
                TextColumn::make('title')
                    ->label('Judul Kegiatan')
                    ->searchable(),

                // Menampilkan Tanggal
                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // KITA PANGGIL NAMA LENGKAPNYA PAKAI BACKSLASH (\) DI DEPAN
                // Ini memaksa Laravel mengambil file yang benar dari folder Tables.
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}