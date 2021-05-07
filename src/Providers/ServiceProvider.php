<?php
namespace Anan\Oss\Providers;

use Anan\Oss\OssClient;
use Anan\Oss\Support\Config;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/alioss.php', 'alioss'
        );

        $this->app->singleton('easyOss', function ($app) {
            return new OssClient();
        });

    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/alioss.php' => config_path('alioss.php'),
        ], 'easyOss.config');
    }

    public function provides(): array
    {
        return ['easyOss'];
    }
}