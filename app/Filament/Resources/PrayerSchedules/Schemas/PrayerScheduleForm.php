<?php

namespace App\Filament\Resources\PrayerSchedules\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms; 
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Carbon\Carbon;
use Filament\Schemas\Components\Utilities\Set; // Import Set sesuai versi Anda
use Filament\Schemas\Components\Utilities\Get; // Import Get (biasanya seteman dengan Set)

class PrayerScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Input Tanggal
                DatePicker::make('date')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        if ($state) {
                            $isFriday = Carbon::parse($state)->isFriday();
                            $set('is_friday', $isFriday);
                        }
                    }),

                // Field tersembunyi
                Hidden::make('is_friday')
                    ->default(false),

                // Group Waktu Sholat
                Section::make('Waktu Sholat')
                    ->schema([
                        TimePicker::make('subuh')->required(),
                        
                        // Dzuhur (Hidden jika Jumat)
                        TimePicker::make('dzuhur')
                            ->label('Dzuhur')
                            ->hidden(fn (Get $get) => $get('is_friday') === true)
                            ->required(fn (Get $get) => $get('is_friday') === false),

                        // Jumat (Visible jika Jumat)
                        TimePicker::make('waktu_jumat')
                            ->label('Sholat Jum\'at')
                            ->visible(fn (Get $get) => $get('is_friday') === true)
                            ->required(fn (Get $get) => $get('is_friday') === true),

                        // Khatib (Visible jika Jumat)
                        TextInput::make('khatib')
                            ->label('Nama Khatib')
                            ->visible(fn (Get $get) => $get('is_friday') === true)
                            ->columnSpanFull(),

                        TimePicker::make('ashar')->required(),
                        TimePicker::make('maghrib')->required(),
                        TimePicker::make('isya')->required(),
                    ])->columns(2),
            ]);
    }
}