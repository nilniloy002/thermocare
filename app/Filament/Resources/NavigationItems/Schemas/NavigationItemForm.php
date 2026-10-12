<?php

namespace App\Filament\Resources\NavigationItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NavigationItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('parent_id')->relationship('parent', 'label')->label('Parent menu')->searchable()->preload(),
            TextInput::make('label')->required(),
            TextInput::make('url')->required()->helperText('Example: /about or /privacy-policy'),
            Select::make('location')->options(['header' => 'Header', 'footer' => 'Footer'])->default('header')->required(),
            Select::make('menu_type')->options(['link' => 'Link', 'dropdown' => 'Dropdown', 'mega' => 'Mega menu'])->default('link')->required()->helperText('Use Dropdown or Mega menu on a parent item with child items.'),
            TextInput::make('menu_group')->label('Mega-menu group')->helperText('For child items only, e.g. Core Engineering.'),
            TextInput::make('icon')->helperText('Lucide icon name, e.g. snowflake, wind, wrench.'),
            Textarea::make('description')->columnSpanFull()->helperText('Short child-item description displayed in a mega menu.'),
            TextInput::make('promo_title')->label('Promo title')->helperText('For mega-menu parent only.'),
            Textarea::make('promo_text')->label('Promo text')->columnSpanFull(),
            TextInput::make('promo_button_label')->label('Promo button label'),
            TextInput::make('promo_button_url')->label('Promo button URL'),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('is_visible')->default(true),
            Toggle::make('open_in_new_tab'),
        ])->columns(2);
    }
}
