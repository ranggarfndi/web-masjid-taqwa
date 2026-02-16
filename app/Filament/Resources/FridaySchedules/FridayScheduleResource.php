<?php

namespace App\Filament\Resources\FridaySchedules;

use App\Filament\Resources\FridaySchedules\Pages\CreateFridaySchedule;
use App\Filament\Resources\FridaySchedules\Pages\EditFridaySchedule;
use App\Filament\Resources\FridaySchedules\Pages\ListFridaySchedules;
use App\Filament\Resources\FridaySchedules\Schemas\FridayScheduleForm;
use App\Filament\Resources\FridaySchedules\Tables\FridaySchedulesTable;
use App\Models\FridaySchedule;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FridayScheduleResource extends Resource
{
    protected static ?string $model = FridaySchedule::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar; // Saya ganti ikon kalender

    protected static ?string $navigationLabel = 'Jadwal Jumat';

    protected static ?string $recordTitleAttribute = 'date';

    public static function form(Schema $schema): Schema
    {
        return FridayScheduleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FridaySchedulesTable::configure($table);
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
            'index' => ListFridaySchedules::route('/'),
            'create' => CreateFridaySchedule::route('/create'),
            'edit' => EditFridaySchedule::route('/{record}/edit'),
        ];
    }
}