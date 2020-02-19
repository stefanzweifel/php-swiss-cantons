# 🇨🇭 PHP Swiss Cantons

![tests](https://github.com/stefanzweifel/php-swiss-cantons/workflows/tests/badge.svg)
[![codecov](https://codecov.io/gh/stefanzweifel/php-swiss-cantons/branch/master/graph/badge.svg)](https://codecov.io/gh/stefanzweifel/php-swiss-cantons)
[![Latest Stable Version](https://poser.pugx.org/wnx/php-swiss-cantons/v/stable)](https://packagist.org/packages/wnx/php-swiss-cantons)
[![Total Downloads](https://poser.pugx.org/wnx/php-swiss-cantons/downloads)](https://packagist.org/packages/wnx/php-swiss-cantons)
[![License](https://poser.pugx.org/wnx/php-swiss-cantons/license)](https://packagist.org/packages/wnx/php-swiss-cantons)

Using Javascript? There's a [port of this package available](https://github.com/stefanzweifel/js-swiss-cantons).

## Installation

### Composer

```shell
composer require "wnx/php-swiss-cantons"
```

### Download

If you don't have access to `composer` you can also download the latest release from the [releases tab](https://github.com/stefanzweifel/php-swiss-cantons/releases). Place the unzipped files in your project. **Don't forget to autoload all files within the `src` directory.**

## Usage
Use the `CantonManager`  Class to interact with this package. Below you find an example how you can use with in the Laravel Framework. Further you find all public API methods for `CantonManager` and `Canton`.

```php
Route::get('/', function (Wnx\SwissCantons\CantonManager $cantonManager) {

    $canton = $cantonManager->getByAbbreviation(Request::get('canton', 'ZH'));
    $cantonName = $canton->setLanguage('de')->getName();

	return view('welcome', compact('cantonName'));

});
```

> This example would work on http://localhost/?canton=BE. It would search for a canton with the abbreviation „BE“ and would  pass the German Canton name (Bern) to the view `welcome.blade`.

## `CantonManager`

Use the `CantonManager` to find a Canton. It will return a new Instance of `Canton` or will throw an `Exception` if it could't find anything.

### `getByAbbreviation()`

Find a Canton by its abbreviation. See [this list](https://en.wikipedia.org/wiki/Cantons_of_Switzerland#List) for available abbreviations.

```php
$cantonManager = new Wnx\SwissCantons\CantonManager();

$canton = $cantonManager->getByAbbreviation('GR');
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

## `Cantons`

This class is used internally but can also be used in your own project if you need a list of all cantons

### `getAll()`

```php
$cantons->getAll(); // Array of `Cantons` objects
```

### `getAllAsArray($defaultLanguage = 'en')`

If you need a list of Cantons for a select input this is the method for you. Just pass the desired language to the method and you will get a simple one dimensional array of all cantons.

```php
$cantons->getAllAsArray(); // Array of cantons. Keys are abbreviations, values are canton names
// [['ZH' => 'Zurich', 'GE' => 'Geneva']]
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@stefanzweifel.io. All security vulnerabilities will be promptly addressed.

## Data Sources

- [https://en.wikipedia.org/wiki/Cantons_of_Switzerland](https://en.wikipedia.org/wiki/Cantons_of_Switzerland)
- [Zipcodes / Amtliches Ortschaftenverzeichnis der Schweiz](https://www.cadastre.ch/de/services/service/plz.html)

## License

MIT
