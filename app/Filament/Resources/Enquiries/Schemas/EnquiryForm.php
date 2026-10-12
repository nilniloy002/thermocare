<?php

namespace App\Filament\Resources\Enquiries\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EnquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->required(),
            TextInput::make('organization'),
            TextInput::make('contact')->required(),
            TextInput::make('service_interest'),
            Textarea::make('message')->columnSpanFull(),
        ])->columns(2);
    }
}
