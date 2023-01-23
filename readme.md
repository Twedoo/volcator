# Stone

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis] 

Stone IO is not a traditional CMS, the idea of its architectural design software is completely different from the traditional CMS because it's built to supports SAAS systems, it's directed mainly to companies and it also supports the space system for each company (space) contains many applications that can be install and delete it not from the entire platform, but only from the user's private space.

The new thing in Stone IO its the IDE based on Vue3 that enables the platform owner to develop his applications and build any application he wants from the user interface without the need to write any line of code by drag & drop.


## Version 

### This stone version in 3.x is not ready for use yet !<br />
We are working hard and smart to get it to the production stage ^^ !<br />
We have dealine **August 28, 2022**<br /> ==> this deadline done !
The nest step  ..we working on Headpiece platform to create and custimiz anything in template based on Tailwindcss without code just by drag & drop new deadline **Mars 28, 2023**

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

### Config web socket with Devilbox

```$xslt
npm run dev && php artisan websockets:serve --host=127.0.0.1
```

Should run this command in same container of project to mount host websocket laravel


### Soketi env variables
```.env
{
    ADAPTER_DRIVER: 'adapter.driver',
    ADAPTER_REDIS_PREFIX: 'adapter.redis.prefix',
    APP_MANAGER_DRIVER: 'appManager.driver',
    APP_MANAGER_DYNAMODB_TABLE: 'appManager.dynamodb.table',
    APP_MANAGER_DYNAMODB_REGION: 'appManager.dynamodb.region',
    APP_MANAGER_DYNAMODB_ENDPOINT: 'appManager.dynamodb.endpoint',
    APP_MANAGER_MYSQL_TABLE: 'appManager.mysql.table',
    APP_MANAGER_MYSQL_VERSION: 'appManager.mysql.version',
    APP_MANAGER_POSTGRES_TABLE: 'appManager.postgres.table',
    APP_MANAGER_POSTGRES_VERSION: 'appManager.postgres.version',
    APP_MANAGER_MYSQL_USE_V2: 'appManager.mysql.useMysql2',
    CHANNEL_LIMITS_MAX_NAME_LENGTH: 'channelLimits.maxNameLength',
    DEBUG: 'debug',
    DEFAULT_APP_ID: 'appManager.array.apps.0.id',
    DEFAULT_APP_KEY: 'appManager.array.apps.0.key',
    DEFAULT_APP_SECRET: 'appManager.array.apps.0.secret',
    DEFAULT_APP_MAX_CONNS: 'appManager.array.apps.0.maxConnections',
    DEFAULT_APP_ENABLE_CLIENT_MESSAGES: 'appManager.array.apps.0.enableClientMessages',
    DEFAULT_APP_ENABLED: 'appManager.array.apps.0.enabled',
    DEFAULT_APP_MAX_BACKEND_EVENTS_PER_SEC: 'appManager.array.apps.0.maxBackendEventsPerSecond',
    DEFAULT_APP_MAX_CLIENT_EVENTS_PER_SEC: 'appManager.array.apps.0.maxClientEventsPerSecond',
    DEFAULT_APP_MAX_READ_REQ_PER_SEC: 'appManager.array.apps.0.maxReadRequestsPerSecond',
    DEFAULT_APP_WEBHOOKS: 'appManager.array.apps.0.webhooks',
    DB_POOLING_ENABLED: 'databasePooling.enabled',
    DB_POOLING_MIN: 'databasePooling.min',
    DB_POOLING_MAX: 'databasePooling.max',
    DB_MYSQL_HOST: 'database.mysql.host',
    DB_MYSQL_PORT: 'database.mysql.port',
    DB_MYSQL_USERNAME: 'database.mysql.user',
    DB_MYSQL_PASSWORD: 'database.mysql.password',
    DB_MYSQL_DATABASE: 'database.mysql.database',
    DB_POSTGRES_HOST: 'database.postgres.host',
    DB_POSTGRES_PORT: 'database.postgres.port',
    DB_POSTGRES_USERNAME: 'database.postgres.user',
    DB_POSTGRES_PASSWORD: 'database.postgres.password',
    DB_POSTGRES_DATABASE: 'database.postgres.database',
    DB_REDIS_HOST: 'database.redis.host',
    DB_REDIS_PORT: 'database.redis.port',
    DB_REDIS_DB: 'database.redis.db',
    DB_REDIS_USERNAME: 'database.redis.username',
    DB_REDIS_PASSWORD: 'database.redis.password',
    DB_REDIS_KEY_PREFIX: 'database.redis.keyPrefix',
    DB_REDIS_SENTINELS: 'database.redis.sentinels',
    DB_REDIS_SENTINEL_PASSWORD: 'database.redis.sentinelPassword',
    DB_REDIS_INSTANCE_NAME: 'database.redis.name',
    EVENT_MAX_CHANNELS_AT_ONCE: 'eventLimits.maxChannelsAtOnce',
    EVENT_MAX_NAME_LENGTH: 'eventLimits.maxNameLength',
    EVENT_MAX_SIZE_IN_KB: 'eventLimits.maxPayloadInKb',
    METRICS_ENABLED: 'metrics.enabled',
    METRICS_DRIVER: 'metrics.driver',
    METRICS_PROMETHEUS_PREFIX: 'metrics.prometheus.prefix',
    METRICS_SERVER_PORT: 'metrics.port',
    PORT: 'port',
    PATH_PREFIX: 'pathPrefix',
    PRESENCE_MAX_MEMBER_SIZE: 'presence.maxMemberSizeInKb',
    PRESENCE_MAX_MEMBERS: 'presence.maxMembersPerChannel',
    QUEUE_DRIVER: 'queue.driver',
    QUEUE_REDIS_CONCURRENCY: 'queue.redis.concurrency',
    RATE_LIMITER_DRIVER: 'rateLimiter.driver',
    SSL_CERT: 'ssl.certPath',
    SSL_KEY: 'ssl.keyPath',
    SSL_PASS: 'ssl.passphrase',
};
```
### Variable .env StoneEcho

```.env

PUSHER_STONE_FORCE_TLS=
PUSHER_STONE_ENCRYPTED=
PUSHER_STONE_WS_HOST='127.0.0.1'
PUSHER_STONE_WS_PORT=6001
PUSHER_STONE_WSS_PORT=6001

MIX_PUSHER_STONE_FORCE_TLS="${PUSHER_STONE_FORCE_TLS}"
MIX_PUSHER_STONE_ENCRYPTED="${PUSHER_STONE_ENCRYPTED}"
MIX_PUSHER_STONE_WS_HOST="${PUSHER_STONE_WS_HOST}"
MIX_PUSHER_STONE_WS_PORT="${PUSHER_STONE_WS_PORT}"
MIX_PUSHER_STONE_WSS_PORT="${PUSHER_STONE_WSS_PORT}"

```

### Pusher call method

```

import Echo from './echo.js';
import {Pusher} from './pusher.js';
window.Pusher = Pusher;

window.StoneEcho =  new Echo({
    broadcaster: 'pusher',
    key: window.PUSHER_APP_KEY,
    cluster: window.PUSHER_APP_CLUSTER,
    forceTLS: !!window.PUSHER_STONE_FORCE_TLS,
    wsHost: window.PUSHER_STONE_WS_HOST,
    wsPort: window.PUSHER_STONE_WS_PORT,
    wssPort: window.PUSHER_STONE_WSS_PORT,
    encrypted: !!window.PUSHER_STONE_ENCRYPTED,
    enabledTransports: ['ws', 'wss']
});


window.StoneEcho.channel('notification.'+window.currentUserId).listen('.notifyNotification', (event) => {
    toastr.success('Hé, <b>ça marche !</b>', '<a href="javascript: void(0);" class="btn btn-outline-primary mb-1">View history</a>');
    console.log(event);
});
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
