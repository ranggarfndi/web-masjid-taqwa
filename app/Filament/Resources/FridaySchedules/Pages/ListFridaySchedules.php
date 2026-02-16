<?php

namespace App\Filament\Resources\FridaySchedules\Pages;

use App\Filament\Resources\FridaySchedules\FridayScheduleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFridaySchedules extends ListRecords
{
    protected static string $resource = FridayScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
