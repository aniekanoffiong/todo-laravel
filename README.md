# Laravel Todo Package

This package provides you with a simple tool to set up a new package and it will let you focus on the development of the package instead of the boilerplate.

## Demo

https://http://lara-todoapp.herokuapp.com/

## Installation

Via Composer

```bash
$ composer require aniekanoffiong/todo-laravel
```

If you do not run Laravel 5.5 (or higher), then add the service provider in `config/app.php`:

```php
Ekanoffiong\TodoLaravel\TodoLaravelServiceProvider::class,
```

If you do run the package on Laravel 5.5+, [package auto-discovery](https://medium.com/@taylorotwell/package-auto-discovery-in-laravel-5-5-ea9e3ab20518) takes care of the magic of adding the service provider.

Afterwards, publish the migrations and views so you can customize as needed.

```bash
$ php artisan vendor:publish --provider="Ekanoffiong\TodoLaravel\TodoLaravelServiceProvider"
```

### Tests
Currently, no tests have been writted but that should be very soon.

## Changelog

Please see [CHANGELOG.md](CHANGELOG.md) for what has changed recently.

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## Credits

- [Aniekan][https://twitter.com/aniekanoffiong]

## License

The EU Public License. Please see [license.md](license.md) for more information.
