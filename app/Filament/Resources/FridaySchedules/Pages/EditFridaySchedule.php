<?php

namespace App\Filament\Resources\FridaySchedules\Pages;

use App\Filament\Resources\FridaySchedules\FridayScheduleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFridaySchedule extends EditRecord
{
    protected static string $resource = FridayScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
