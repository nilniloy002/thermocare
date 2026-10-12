<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required(),
            TextInput::make('slug')->required()->unique(ignoreRecord: true),
            Select::make('family')->options(['refrigeration' => 'Refrigeration', 'cooling' => 'Cooling', 'hvac' => 'HVAC']),
            TextInput::make('brand'),
            TextInput::make('image')->label('Image path'),
            Textarea::make('summary')->columnSpanFull(),
            Toggle::make('is_published')->default(true),
        ])->columns(2);
    }
}
