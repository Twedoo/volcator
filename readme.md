# Stone

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis] 

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Version 

this stone version in main-dev is not ready for use yet !<br />
We are working hard and smart to get it to the production stage ^^ !<br />
We have dealine **August 28, 2022**<br />

## Installation

Via Composer

``` bash
$ composer require twedoo/stone
```

## Usage

From scratch project install default migration table of Laravel :
``` bash
$ php artisan migrate
```

``` bash
$ php artisan migrate:install
```

From existing project:

``` bash
$ php artisan stone:migration
```

Migrate all stone tables:

``` bash
$ php artisan migrate
```

Publish stone views and translate (lang):

``` bash
php artisan vendor:publish --provider="Twedoo\Stone\StoneServiceProvider"
```

Seeder Data:

``` bash
php artisan stone:seeder
```

Mode dev simple command one line (should launch this when the DB not contains table): 

```
php artisan migrate:install && php artisan stone:migration && php artisan migrate && php artisan stone:seeder
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email houssem.maamria@twedoo.com instead of using the issue tracker.

## Credits

- [Houssem MAAMRIA][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/twedoo/stone.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/twedoo/stone.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/twedoo/stone/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/twedoo/stone
[link-downloads]: https://packagist.org/packages/twedoo/stone
[link-travis]: https://travis-ci.org/twedoo/stone
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/twedoo
[link-contributors]: ../../contributors
