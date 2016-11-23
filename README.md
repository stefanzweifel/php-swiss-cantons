![Bünderspitz, Adelboden](https://cloud.githubusercontent.com/assets/1080923/20579057/c5b79272-b1ca-11e6-9f60-d8c40e0f41ab.png)

# 🇨🇭 Swiss Cantons

[![Build Status](https://travis-ci.org/stefanzweifel/php-swiss-cantons.svg?branch=master)](https://travis-ci.org/stefanzweifel/php-swiss-cantons)
[![StyleCI](https://styleci.io/repos/62249401/shield)](https://styleci.io/repos/62249401)
[![Code Climate](https://codeclimate.com/github/stefanzweifel/php-swiss-cantons/badges/gpa.svg)](https://codeclimate.com/github/stefanzweifel/php-swiss-cantons)
[![Test Coverage](https://codeclimate.com/github/stefanzweifel/php-swiss-cantons/badges/coverage.svg)](https://codeclimate.com/github/stefanzweifel/php-swiss-cantons/coverage)
[![Latest Stable Version](https://poser.pugx.org/wnx/php-swiss-cantons/v/stable)](https://packagist.org/packages/wnx/php-swiss-cantons)
[![Total Downloads](https://poser.pugx.org/wnx/php-swiss-cantons/downloads)](https://packagist.org/packages/wnx/php-swiss-cantons)
[![Latest Unstable Version](https://poser.pugx.org/wnx/php-swiss-cantons/v/unstable)](https://packagist.org/packages/wnx/php-swiss-cantons)
[![License](https://poser.pugx.org/wnx/php-swiss-cantons/license)](https://packagist.org/packages/wnx/php-swiss-cantons)


## Installation

### Composer

```shell
composer require "wnx/php-swiss-cantons"
```

### Download

If you don't have access to `composer` you can also download the latest release from the [releases tab](https://github.com/stefanzweifel/php-swiss-cantons/releases). Place the unzipped files in your project. **Don't forget to autoload all files within the `src` directory.**

## Usage
Use the `CantonManager`  Class to interact with this package. Below you find an example how you can use with in the Laravel Framework. Further you find all public API methods for `CantonManager` and `Canton`.

```php
Route::get('/', function (Wnx\SwissCantons\CantonManager $cantonManager) {

    $canton = $cantonManager->getByAppreviation(Request::get('canton', 'ZH'));
    $cantonName = $canton->setLanguage('de')->getName();

		return view('welcome', compact('cantonName'));

});
```

> This example would work on http://localhost/?canton=BE. It would search for a canton with the abbreviation „BE“ and would  pass the German Canton name (Bern) to the view `welcome.blade`.

## `CantonManager`

Use the `CantonManager` to find a Canton. It will return a new Instance of `Canton` or will throw an `Exception` if it could't find anything.

### `getByAppreviation()`

Find a Canton by its abbreviation. See [this list](https://en.wikipedia.org/wiki/Cantons_of_Switzerland#List) for available abbreviations.

```php
$cantonManager = new Wnx\SwissCantons\CantonManager();

$canton = $cantonManager->getByAppreviation('GR');
// $canton is an instance of Wnx\SwissCantons\Canton
```

### `getByName()`

Search for a Canton by it's name. The name must exactly match one of the translations of the Canton (German, French, Italian, Romansh or English).

```php
$cantonManager = new Wnx\SwissCantons\CantonManager();

$canton = $cantonManager->getByName('Zürich');
// $canton is an instance of Wnx\SwissCantons\Canton
```

### `getByZipcode()`

Search for a Canton by a zipcode.

```php
$cantonManager = new Wnx\SwissCantons\CantonManager();

$canton = $cantonManager->getByZipcode(3005);
// $canton is an instance of Wnx\SwissCantons\Canton
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
Return the Name for the given Canton. If the method is used without calling the `setLanguage()` Method first it will return the name in English.

```php
$canton->getName(); // Grisons
$canton->setLanguage('de')->getName(); // Graubünden
```


### `getAbbreviation()`
Return the offical abbreviation for the given Canton.

```php
$canton->getAbbreviation(); // e.g. ZH
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@stefanzweifel.io. All security vulnerabilities will be promptly addressed.

## Build Docs

Docs are available [here](https://stefanzweifel.github.io/php-swiss-cantons/). They can be built with the following command.

```shell
composer build:docs
```

## Data Sources

- [https://en.wikipedia.org/wiki/Cantons_of_Switzerland](https://en.wikipedia.org/wiki/Cantons_of_Switzerland)
- [Zipcodes / Amtliches Ortschaftenverzeichnis der Schweiz](http://www.cadastre.ch/internet/kataster/de/home/services/service/plz.html)

## License

MIT
