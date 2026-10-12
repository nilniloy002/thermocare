<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required(),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            TextInput::make('location'),
            DatePicker::make('completed_at'),
            TextInput::make('image')->label('Image path'),
            Toggle::make('is_published')->default(true),
            Textarea::make('summary')->columnSpanFull(),
        ])->columns(2);
    }
}
