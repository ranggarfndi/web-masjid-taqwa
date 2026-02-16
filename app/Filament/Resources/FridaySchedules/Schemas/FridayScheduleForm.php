<?php

namespace App\Filament\Resources\FridaySchedules\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class FridayScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Jadwal Jumat')
                    ->schema([
                        // Input Tanggal
                        DatePicker::make('date')
                            ->label('Tanggal Jumat')
                            ->required()
                            ->unique(ignoreRecord: true),

                        // Input Waktu
                        TimePicker::make('waktu')
                            ->label('Waktu Mulai')
                            ->default('12:00')
                            ->required(),

                        // Input Khatib
                        TextInput::make('khatib')
                            ->label('Nama Khatib')
                            ->required()
                            ->placeholder('Contoh: Ust. H. Abdul Somad')
                            ->columnSpanFull(),

                        // Input Imam
                        TextInput::make('imam')
                            ->label('Nama Imam')
                            ->placeholder('Kosongkan jika sama dengan Khatib')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}