<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Storage;

class SiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.site-settings';

    protected static string|\UnitEnum|null $navigationGroup = 'Administration';

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?string $slug = 'settings';

    public ?array $data = [];

    public ?string $currentLightLogo = null;

    public ?string $currentDarkLogo = null;

    public ?string $currentFavicon = null;

    public function mount(): void
    {
        $settings = SiteSetting::pluck('value', 'key')->all();
        $this->currentLightLogo = $settings['logo_light'] ?? null;
        $this->currentDarkLogo = $settings['logo_dark'] ?? null;
        $this->currentFavicon = $settings['favicon'] ?? null;
        unset($settings['logo_light'], $settings['logo_dark'], $settings['favicon']);
        $this->form->fill($settings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Branding')->schema([
                TextInput::make('site_name')->label('Site title')->required(),
                TextInput::make('tagline'),
                Placeholder::make('current_light_logo')->label('Current light logo')->content($this->preview($this->currentLightLogo)),
                Placeholder::make('current_dark_logo')->label('Current dark logo')->content($this->preview($this->currentDarkLogo)),
                FileUpload::make('logo_light')->label('Upload replacement light logo')->image()->disk('public')->directory('site')->visibility('public')->fetchFileInformation(false),
                FileUpload::make('logo_dark')->label('Upload replacement dark logo')->image()->disk('public')->directory('site')->visibility('public')->fetchFileInformation(false),
                Placeholder::make('current_favicon')->label('Current favicon')->content($this->preview($this->currentFavicon)),
                FileUpload::make('favicon')->label('Upload replacement favicon')->image()->disk('public')->directory('site')->visibility('public')->fetchFileInformation(false),
            ])->columns(2),
            Section::make('Contact & Email')->schema([
                TextInput::make('email')->email()->required()->label('Notification email'),
                TextInput::make('contact_email')->email()->label('Public contact email'),
                TextInput::make('phone')->label('Primary phone'),
                TextInput::make('phone_secondary')->label('Secondary phone'),
                Textarea::make('address')->label('Dhaka office address')->columnSpanFull(),
                Textarea::make('chattogram_address')->label('Chattogram office address')->columnSpanFull(),
                TextInput::make('dhaka_map_url')->label('Dhaka office Google Maps link')->url()->rules(['starts_with:https://'])->maxLength(2048)->helperText('Paste the Google Maps share link. Leave blank to search by office address.'),
                TextInput::make('chattogram_map_url')->label('Chattogram office Google Maps link')->url()->rules(['starts_with:https://'])->maxLength(2048)->helperText('Paste the Google Maps share link. Leave blank to search by office address.'),
                TextInput::make('mail_host')->label('SMTP host'),
                TextInput::make('mail_port')->numeric()->label('SMTP port'),
                TextInput::make('mail_username')->label('SMTP username'),
                TextInput::make('mail_password')->password()->revealable()->label('SMTP password'),
            ])->columns(2),
            Section::make('SEO & Webmaster Tools')->schema([
                Textarea::make('meta_description')->columnSpanFull(),
                TextInput::make('google_webmaster_verification')->label('Google Search Console verification code')->columnSpanFull(),
            ]),
            Section::make('Social Media')->schema([
                TextInput::make('facebook_url')->url()->label('Facebook URL'),
                TextInput::make('linkedin_url')->url()->label('LinkedIn URL'),
                TextInput::make('youtube_url')->url()->label('YouTube URL'),
            ])->columns(3),
            Section::make('Landing Page')->schema([
                TextInput::make('home_hero_title')->label('Hero title')->columnSpanFull(),
                Textarea::make('home_hero_description')->label('Hero description')->columnSpanFull(),
            ]),
        ])->statePath('data');
    }

    public function save(): void
    {
        foreach ($this->form->getState() as $key => $value) {
            // Empty FileUpload fields arrive from Livewire as an empty array. They
            // mean "keep the current image", rather than "erase its stored path".
            if (in_array($key, ['logo_light', 'logo_dark', 'favicon'], true)) {
                if ($value === null || $value === '' || $value === [] || $value === '[]') {
                    continue;
                }

                if (is_array($value)) {
                    $value = reset($value) ?: null;
                }
            }

            if ($value !== null) {
                SiteSetting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => 'general']);
            }
        }

        $this->currentLightLogo = SiteSetting::where('key', 'logo_light')->value('value');
        $this->currentDarkLogo = SiteSetting::where('key', 'logo_dark')->value('value');
        $this->currentFavicon = SiteSetting::where('key', 'favicon')->value('value');

        Notification::make()->title('Site settings saved')->success()->send();
    }

    private function preview(?string $path): HtmlString
    {
        if (! $path || $path === '[]') {
            return new HtmlString('<span class="text-sm text-gray-500">No image uploaded.</span>');
        }

        $url = str_starts_with($path, 'site/') ? '/storage/'.$path : '/'.$path;

        return new HtmlString('<img src="'.e($url).'" alt="Current site asset" style="max-height: 96px; max-width: 280px; border-radius: 8px; border: 1px solid #e5e7eb; padding: 8px; background: #fff;">');
    }
}
