<?php

namespace App\Filament\Resources\PrayerSchedules;

use App\Filament\Resources\PrayerSchedules\Pages\CreatePrayerSchedule;
use App\Filament\Resources\PrayerSchedules\Pages\EditPrayerSchedule;
use App\Filament\Resources\PrayerSchedules\Pages\ListPrayerSchedules;
use App\Filament\Resources\PrayerSchedules\Schemas\PrayerScheduleForm;
use App\Filament\Resources\PrayerSchedules\Tables\PrayerSchedulesTable;
use App\Models\PrayerSchedule;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PrayerScheduleResource extends Resource
{
    protected static ?string $model = PrayerSchedule::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'date';

    public static function form(Schema $schema): Schema
    {
        return PrayerScheduleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PrayerSchedulesTable::configure($table);
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
            'index' => ListPrayerSchedules::route('/'),
            'create' => CreatePrayerSchedule::route('/create'),
            'edit' => EditPrayerSchedule::route('/{record}/edit'),
        ];
    }
}
