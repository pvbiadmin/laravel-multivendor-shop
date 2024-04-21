<?php

namespace App\Providers;

use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrap();

        $general_setting = GeneralSetting::query()->first();
        $logo_setting = LogoSetting::query()->first();
        $mailSetting = EmailConfiguration::first();

        /**
         * Set Timezone
         */
        Config::set('app.timezone', $general_setting->timezone);

        /** Set Mail Config */
        Config::set('mail.mailers.smtp.host', $mailSetting->host);
        Config::set('mail.mailers.smtp.port', $mailSetting->port);
        Config::set('mail.mailers.smtp.encryption', $mailSetting->encryption);
        Config::set('mail.mailers.smtp.username', $mailSetting->username);
        Config::set('mail.mailers.smtp.password', $mailSetting->password);

        /**
         * Access settings at all views
         */
        View::composer('*', function ($view) use ($general_setting, $logo_setting) {
            $view->with([
                'settings' => $general_setting,
                'logo_setting' => $logo_setting
            ]);
        });
    }
}
