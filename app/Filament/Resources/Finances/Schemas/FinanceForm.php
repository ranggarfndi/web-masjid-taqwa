<?php

namespace App\Filament\Resources\Finances\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Schemas\Components\Section;

class FinanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Transaksi')
                    ->schema([
                        Forms\Components\DatePicker::make('date')
                            ->label('Tanggal Transaksi')
                            ->required()
                            ->default(now()),

                        Forms\Components\Select::make('category')
                            ->label('Kategori Dana')
                            ->options([
                                'masjid' => 'Infaq Masjid',
                                'yatim' => 'Infaq Anak Yatim',
                            ])
                            ->required(),

                        Forms\Components\Select::make('type')
                            ->label('Jenis Transaksi')
                            ->options([
                                'pemasukan' => 'Pemasukan (Uang Masuk)',
                                'pengeluaran' => 'Pengeluaran (Uang Keluar)',
                            ])
                            ->default('pemasukan')
                            ->required(),

                        Forms\Components\TextInput::make('amount')
                            ->label('Nominal (Rp)')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        Forms\Components\Textarea::make('description')
                            ->label('Keterangan')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}