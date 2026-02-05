<?php

namespace App\Filament\Resources\Finances\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
// Import Action Manual Satu per Satu agar Tidak Merah
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class FinancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('date', 'desc')
            ->columns([
                TextColumn::make('date')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('category')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'masjid' => 'Infaq Masjid',
                        'yatim' => 'Anak Yatim',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'masjid' => 'info',
                        'yatim' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->color(fn (string $state): string => match ($state) {
                        'pemasukan' => 'success',
                        'pengeluaran' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('description')
                    ->searchable()
                    ->limit(30),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Filter Kategori')
                    ->options([
                        'masjid' => 'Infaq Masjid',
                        'yatim' => 'Infaq Anak Yatim',
                    ]),
            ])
            ->actions([
                // Panggil langsung class yang sudah di-import di atas
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