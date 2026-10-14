<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        $settings = SiteSetting::pluck('value', 'key');
        $brandUrl = static function ($path, $fallback) {
            $path = is_string($path) && $path !== '[]' && $path !== '' ? $path : $fallback;
            return str_starts_with($path, 'site/') ? '/storage/'.$path : '/'.ltrim($path, '/');
        };
        \Illuminate\Support\Facades\View::share([
            'brandLightUrl' => $brandUrl($settings->get('logo_light'), 'site/brand-light.png'),
            'brandDarkUrl' => $brandUrl($settings->get('logo_dark'), 'site/brand-dark.png'),
        ]);
        if ($settings->get('mail_host')) {
            config([
                'mail.mailers.smtp.host' => $settings->get('mail_host'),
                'mail.mailers.smtp.port' => (int) ($settings->get('mail_port') ?: 465),
                'mail.mailers.smtp.username' => $settings->get('mail_username'),
                'mail.mailers.smtp.password' => $settings->get('mail_password') ?: env('MAIL_PASSWORD'),
                'mail.mailers.smtp.encryption' => 'ssl',
                'mail.from.address' => $settings->get('email') ?: config('mail.from.address'),
            ]);
        }
    }
}
