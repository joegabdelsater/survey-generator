<?php
namespace Joegabdelsater\SurveyGenerator;

use Illuminate\Support\ServiceProvider;

class SurveyGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadMigrationsFrom([
            __DIR__.'/Migrations/'
        ]);

        $this->publishes([
            __DIR__.'/Models/' => app_path('Models')
        ], 'survey-generator-models');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind('survey-generator', function () {
            return new SurveyGenerator();
        });
    }
}
