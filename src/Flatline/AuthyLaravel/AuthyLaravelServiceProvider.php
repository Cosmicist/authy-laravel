<?php namespace Flatline\AuthyLaravel;

use Illuminate\Support\ServiceProvider;

class AuthyLaravelServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('flatline/authy-laravel');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Authy_Api', function($app)
        {
            if (!class_exists("Resty"))
            {
                require base_path('vendor/resty/resty/Resty.php');
            }

            $sandbox = (bool) $app->config['authy-laravel::sandbox'];

            $api_key = $app->config['authy-laravel::'.($sandbox ? 'sandbox_' : '') . 'api_key'];

            $api_url = $sandbox
                ? "http://sandbox-api.authy.com"
                : "https://api.authy.com";

            return new \Authy_Api($api_key, $api_url);
        });

        $this->app->bindShared('authy', function($app)
        {
            return $app->make('Authy_Api');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('authy');
    }

}
