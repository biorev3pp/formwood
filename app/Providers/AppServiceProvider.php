<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $settings = Settings::where('section', 1)->where('status', 1)->get();
        $allsettings = [];
        foreach ($settings as $value) {
            $allsettings[$value->name] = $value->value;
        }
        View::share('MEDIA_URL', env('MEDIA_URL'));
        View::share(compact('allsettings'));
    }
}
