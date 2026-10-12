<?php

namespace App\Filament\Resources\EmailLogs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmailLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('recipient')->disabled(),
            TextInput::make('subject')->disabled(),
            TextInput::make('status')->disabled(),
            Textarea::make('error_message')->disabled()->columnSpanFull(),
        ])->columns(2);
    }
}
