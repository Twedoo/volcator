# Stone

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis] 

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Version 

This stone version in 3.x is not ready for use yet !<br />
We are working hard and smart to get it to the production stage ^^ !<br />
We have dealine **August 28, 2022**<br />

## Installation

Via Composer

``` bash
$ composer require twedoo/stone
```

Publish stone views and translate (lang):

``` bash
php artisan vendor:publish --provider="Twedoo\Stone\StoneServiceProvider"
```

## Usage

From Laravel scratch project install default migration table of Laravel and Stone (**Should add DB connection in .env and launch commands**):



``` bash
$ php artisan stone:migration
```


``` bash
$ php artisan migrate:install
```

``` bash
$ php artisan migrate
```
 

``` bash
php artisan stone:seeder
```

In another way use command one line:

```
php artisan stone:migration && php artisan migrate:install && php artisan migrate && php artisan stone:seeder
```


## From existing project:

``` bash
$ php artisan stone:migration
```

Migrate all stone tables:

``` bash
$ php artisan migrate
```

## Change model User App\Models\User to :

````
namespace App\Models;

use Twedoo\StoneGuard\Models\User as StoneUser;

class User extends StoneUser
{
    /**
     *
     */
}

````

It's done :D refresh your application !

## For developers (Mode Dev)

Only mode Dev use command one line to purge all Stone tables and regenerate them automatically: 

```
php artisan stone:migration -p true && php artisan stone:migration  && php artisan migrate:install && php artisan migrate && php artisan stone:seeder
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
