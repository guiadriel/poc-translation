<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        function translations($json)
        {
            if(!file_exists($json)) {
                return [];
            }
            return require($json);
        }

        function getTranslations($path)
        {
            $translations = [];
            $files = glob($path . '/*.php');
            foreach($files as $file) {
                $translations_file = translations($file);
                $translations = array_merge($translations, [ basename($file, ".php") => $translations_file]);
            }
            return $translations;
        }


        //
        Inertia::share([
            'locale' => function () {
                return app()->getLocale();
            },
            'language' => function () {
                return getTranslations(base_path('lang/' . app()->getLocale()));;
            }
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
