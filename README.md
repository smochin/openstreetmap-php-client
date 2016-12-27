
# OpenStreetMap PHP Client
[![Join the chat at https://gitter.im/smochin/openstreetmap-php-client](https://badges.gitter.im/smochin/openstreetmap-php-client.svg)](https://gitter.im/smochin/openstreetmap-php-client?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Total Downloads](https://img.shields.io/packagist/dt/smochin/openstreetmap-php-client.svg?style=flat-square)](https://packagist.org/packages/smochin/openstreetmap-php-client)
[![Latest Stable Version](https://img.shields.io/packagist/v/smochin/openstreetmap-php-client.svg?style=flat-square)](https://packagist.org/packages/smochin/openstreetmap-php-client)
![Branch master](https://img.shields.io/badge/branch-master-brightgreen.svg?style=flat-square)
[![Build Status](https://img.shields.io/travis/smochin/openstreetmap-php-client/master.svg?style=flat-square)](http://travis-ci.org/#!/smochin/openstreetmap-php-client)

A simple PHP Client for [http://openstreetmap.org](http://openstreetmap.org).

## Installation
Package is available on [Packagist](http://packagist.org/packages/smochin/openstreetmap-php-client),
you can install it using [Composer](http://getcomposer.org).

```shell
composer require smochin/openstreetmap-php-client
```

### Dependencies
- PHP 7
- json extension
- cURL extension

## Get started

### Initialize the Crawler
```php
$client = new Smochin\OpenStreetMap\Client();
```

### Reverse geocoding
```php
$address = $client->reverse(-8.047562, -34.876964);
```
