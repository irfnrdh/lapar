<?php

namespace irfnrdh\laper;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Parse\ParseClient;

class ParseServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();

        $this->setupParse();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/parse.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('parse.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('parse');
        }

        $this->mergeConfigFrom($source, 'parse');
    }

    /**
     * Setup parse.
     *
     * @return void
     */
    protected function setupParse()
    {
        $config = $this->app->config->get('parse');

        ParseClient::initialize($config['app_id'], $config['rest_key'], $config['master_key']);

        if (isset($config['server_url']) && isset($config['mount_path'])) {
            $serverURL = rtrim($config['server_url'], '/');
            $mountPath = trim($config['mount_path'], '/') . '/';

            ParseClient::setServerURL($serverURL, $mountPath);
        }

        if (isset($config['session']) && $config['session'] === 'laravel') {
            ParseClient::setStorage(new ParseSessionStorage($this->app->session));
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            //
        ];
    }
}
