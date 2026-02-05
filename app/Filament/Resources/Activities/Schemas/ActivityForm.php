<?php

namespace App\Filament\Resources\Activities\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms; // Penting agar Forms\Components terbaca
use Illuminate\Support\Str; // Penting agar Str::slug terbaca

class ActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Input Judul
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                
                // Input Slug
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->readOnly()
                    ->maxLength(255),
                
                // Input Tanggal
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->default(now()),

                // Upload Gambar
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('activities')
                    ->columnSpanFull(),

                // Editor Konten
                Forms\Components\RichEditor::make('content')
                    ->columnSpanFull(),
            ]);
    }
}