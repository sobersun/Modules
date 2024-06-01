# Events Module v1.0

The Events Module is a Laravel package that provides functionality for logging events with model data.

## Installation

1.Add the service provider to the `providers` array in `config/app.php`:

    ```php
    'providers' => [
        // Other service providers...

        App\Modules\Events\Providers\EventsServiceProvider::class,
    ],
    ```

2. Publish the vendor if necessary

    ```bash
    php artisan vendor:publish 
    ```

## Usage

Once installed and configured, the Events Module will automatically log events with model data.

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
