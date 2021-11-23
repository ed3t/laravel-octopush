<?php

namespace OctopushSms;

use Illuminate\Support\ServiceProvider;
use Octopush\Api as SmsApi;

/**
 *  Service Provider for Octopush-sdk
 */
class OctopushServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = false;

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // Config
        $configPath = __DIR__ . '/../../config/octopush.php';
        $this->mergeConfigFrom($configPath, 'octopush');
        // Singleton
        $this->app->singleton('octopush', function ($app) {
            $login = $app['config']['octopush']['login'];
            $key = $app['config']['octopush']['api_key'];
            $type = $app['config']['octopush']['sms_type'];
            $mode = $app['config']['octopush']['sms_mode'];
            $sender = $app['config']['octopush']['sms_sender'];
            return new SmsApi($login, $key, $type, $mode, $sender);
        });
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../../config/octopush.php';
        $this->publishes([
          $configPath => config_path('octopush.php'),
        ], 'config');
    }
}
