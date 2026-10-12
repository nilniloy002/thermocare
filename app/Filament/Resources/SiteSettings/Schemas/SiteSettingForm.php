<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('key')->required()->unique(ignoreRecord: true)->helperText('Example: site_name, phone, email, address'),
            Select::make('group')->options(['general' => 'General', 'contact' => 'Contact', 'seo' => 'SEO'])->default('general')->required(),
            Textarea::make('value')->required()->columnSpanFull(),
        ])->columns(2);
    }
}
