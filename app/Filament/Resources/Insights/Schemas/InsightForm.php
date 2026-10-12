<?php

namespace App\Filament\Resources\Insights\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InsightForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')->required(),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            DateTimePicker::make('published_at'),
            Toggle::make('is_published')->default(true),
            TextInput::make('image')->label('Image path'),
            Textarea::make('excerpt')->columnSpanFull(),
            Textarea::make('body')->columnSpanFull()->rows(10),
        ])->columns(2);
    }
}
