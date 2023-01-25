# 🇨🇭 PHP Swiss Cantons

![tests](https://github.com/stefanzweifel/php-swiss-cantons/workflows/tests/badge.svg)
[![codecov](https://codecov.io/gh/stefanzweifel/php-swiss-cantons/branch/master/graph/badge.svg)](https://codecov.io/gh/stefanzweifel/php-swiss-cantons)
[![Latest Stable Version](https://poser.pugx.org/wnx/php-swiss-cantons/v/stable)](https://packagist.org/packages/wnx/php-swiss-cantons)
[![Total Downloads](https://poser.pugx.org/wnx/php-swiss-cantons/downloads)](https://packagist.org/packages/wnx/php-swiss-cantons)
[![License](https://poser.pugx.org/wnx/php-swiss-cantons/license)](https://packagist.org/packages/wnx/php-swiss-cantons)

Using Javascript? Check out [@stefanzweifel/js-swiss-cantons](https://github.com/stefanzweifel/js-swiss-cantons).

## Installation

The easiest way to install the package is by using composer. The package requires PHP 7.4.

```shell
composer require "wnx/php-swiss-cantons"
```

## Usage
Use the `CantonManager`  Class to interact with this package. Below you find an example how you can use with in the Laravel Framework. Further you find all public API methods for `CantonManager` and `Canton`.

```php
<?php 

use Wnx\SwissCantons\CantonManager;

$cantonManager = new CantonManager();

/** @var \Wnx\SwissCantons\Canton $canton */
$canton = $cantonManager->getByAbbreviation('zh');
$canton = $cantonManager->getByName('Zurigo');
$canton = $cantonManager->getByZipcode(8000);

// "Zürich"
$cantonName = $canton->setLanguage('de')->getName();

```

## `CantonManager`

Use the `CantonManager` to find a Canton. It will return a new Instance of `Canton` or throws an `Exception` if no Canton could be found for the abbreviation, name or zipcode.

### `getByAbbreviation()`

Find a Canton by its abbreviation. See [this list](https://en.wikipedia.org/wiki/Cantons_of_Switzerland#List) for available abbreviations.

```php
$cantonManager = new Wnx\SwissCantons\CantonManager();

/** @var \Wnx\SwissCantons\Canton $canton */
$canton = $cantonManager->getByAbbreviation('GR');
```

### `getByName()`

Search for a Canton by it's name. The name must exactly match one of the translations of the Canton (German, French, Italian, Romansh or English).

```php
$cantonManager = new Wnx\SwissCantons\CantonManager();

/** @var \Wnx\SwissCantons\Canton $canton */
$canton = $cantonManager->getByName('Zürich');
```

### `getByZipcode()`

Search for a Canton by a zipcode.

```php
$cantonManager = new Wnx\SwissCantons\CantonManager();

/** @var \Wnx\SwissCantons\Canton $canton */
$canton = $cantonManager->getByZipcode(3005);
```

## `Canton`

### `setLanguage($string = 'en')`
Set the language, which should be used to display the name of the canton. The following languages are currently supported.

- German (`de`)
- French (`fr`)
- Italian (`it`)
- Romansh (`rm`)
- English (`en`, default)

The method returns the current instance of `Canton` for easier method chaining.

```php
$canton->setLanguage('rm');
```

```php
$canton->setLanguage('fr')->getName();
```


### `getName()`
Return the Name for the given Canton. If the method is used without calling the `setLanguage()` method first, it will return the name in English.

```php
$canton->getName(); // Grisons
$canton->setLanguage('de')->getName(); // Graubünden
```


### `getAbbreviation()`
Return the offical abbreviation for the given Canton.

```php
$canton->getAbbreviation(); // e.g. ZH
```

## `Cantons`

This class is used internally but can also be used in your own project if you need a list of all cantons

### `getAll()`
Returns an array containg `Wnx\SwissCantons\Canton` objects.

```php
use Wnx\SwissCantons\Cantons;

$cantons = (new Cantons)->getAll();
```

### `getAllAsArray($defaultLanguage = 'en')`
Returns a one dimensionl array of all Cantons. The key is the abbreviation. The value will be the translated name of the Canton.
The default language is English. Pass one of the valid languages to the method, to localize the names.

```php
use Wnx\SwissCantons\Cantons;

$cantons = (new Cantons)->getAllAsArray('en');

$cantonsAsArray = $cantons->getAllAsArray(); 

// var_dump($cantonsAsArray);
// [
//     'ZH' => 'Zurich', 
//     'GE' => 'Geneva',
//     // ...
// ]
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to stefan@stefanzweifel.dev. All security vulnerabilities will be promptly addressed.

## Data Sources

- [https://en.wikipedia.org/wiki/Cantons_of_Switzerland](https://en.wikipedia.org/wiki/Cantons_of_Switzerland)
- [Zipcodes / Swiss Post](https://swisspost.opendatasoft.com/explore/dataset/plz_verzeichnis_v2/information/)

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/stefanzweifel/laravel-stats/tags).

## Credits

* [Stefan Zweifel](https://github.com/stefanzweifel)
* [All Contributors](https://github.com/stefanzweifel/php-swiss-cantons/graphs/contributors)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
