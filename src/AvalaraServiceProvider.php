<?php

namespace Mjmarianetti\Avalara;

use Illuminate\Support\ServiceProvider;

class AvalaraServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->isLumen()) {
            return;
        }

      // Publish config files
      $this->publishes([
          __DIR__.'/../config/config.php' => config_path('avalara.php'),
      ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerAvalara();
    }

    /**
     * Register the application bindings.
     */
    private function registerZoho()
    {
        $this->app->bind('Mjmarianetti\Avalara\AvalaraClient', function ($app) {
          if ($this->isLumen()) {
              $app->configure('avalara');
          }

          $config = [];
          $config['api_key'] = config('avalara.api_key');
          return new  AvalaraClient($config);
      });
    }

    private function isLumen()
    {
        return is_a(\app(), 'Laravel\Lumen\Application');
    }
}
