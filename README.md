AuthyLaravel
============

This is a really simple laravel package that wraps Authy_Api.

Installation
------------

1.  Install the `flatline/authy-laravel` package

    ```shell
    $ composer require "flatline/authy-laravel:dev-master"
    ```

2.  Update `app/config/app.php` to activate Authy

    ```php
    # Add `AuthyLaravelServiceProvider` to the `providers` array
    'providers' => array(
        ...
        'Flatline\AuthyLaravel\AuthyLaravelServiceProvider',
    )

    # Add the `Authy` facade to the `aliases` array
    'aliases' => array(
        ...
        'Authy' => 'Flatline\AuthyLaravel\Facades\Authy',
    )
    ```

The facade is not required, as you can request the Authy_Api class through the
container with any variation of the following:

```php
$authy = app('authy');

// or:

$authy = App::make('Authy_Api');

// or even:

class Foo
{
    protected $authy;

    public function __construct(\Authy_Api $authy)
    {
        $this->authy = $authy;
    }
}
```

In all of the cases, the calss will be automatically initialized with your
corresponding API key and url (production or sandbox) before injection.

Configuration
-------------

1.  Generate a template Authy config file

    ```shell
    $ php artisan config:publish flatline/authy-laravel
    ```

2.  Update `app/config/packages/flatline/authy-laravel/config.php` with your
    Authy API keys and turn on or off sandbox mode:

    ```php
    return [
        /*
        |--------------------------------------------------------------------------
        | Sandbox Mode
        |--------------------------------------------------------------------------
        |
        | While you're developing your application you might want to work on the
        | sandbox environment. To do so, just set this variable to "true".
        |
        */
        'sandbox' => false,

        /*
        |--------------------------------------------------------------------------
        | API Keys
        |--------------------------------------------------------------------------
        |
        | First, you'll need to create your application on the Authy Dashboard.
        | Once you created your Authy App, copy the API keys and paste them here.
        |
        */
        'api_key' => 'your-api-key',
        'sandbox_api_key' => 'your-sandbox-api-key',
    ];
    ```
