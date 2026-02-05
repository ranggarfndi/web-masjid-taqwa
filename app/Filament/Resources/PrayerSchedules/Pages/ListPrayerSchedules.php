<?php

namespace App\Filament\Resources\PrayerSchedules\Pages;

use App\Filament\Resources\PrayerSchedules\PrayerScheduleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPrayerSchedules extends ListRecords
{
    protected static string $resource = PrayerScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
