<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Pages\Dashboard;
use App\Models\HeaderSetting;
use App\Observers\HeaderSettingObserver;

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
        
    }
}
