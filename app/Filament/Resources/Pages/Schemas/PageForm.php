<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required(),
            TextInput::make('slug')->required()->unique(ignoreRecord: true)->helperText('For example: privacy-policy'),
            Select::make('template')->options([
                'compressor' => 'Compressor product page',
                'condenser' => 'Condenser product page',
                'evaporator' => 'Evaporator product page',
                'freezing-systems' => 'Freezing systems product page',
                'chilled-water-systems' => 'Chilled water systems product page',
                'sandwich-panels' => 'Sandwich panels product page',
            ])->helperText('Choose a frontend layout for an individual product page.'),
            Textarea::make('meta_description')->columnSpanFull(),
            Toggle::make('is_published')->default(true),
            RichEditor::make('content')->columnSpanFull(),
        ])->columns(2);
    }
}
