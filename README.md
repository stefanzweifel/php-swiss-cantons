# 🇨🇭 Swiss Cantons

[![Build Status](https://travis-ci.org/stefanzweifel/php-swiss-cantons.svg?branch=master)](https://travis-ci.org/stefanzweifel/php-swiss-cantons)

## Installation

```
composer require "wnx/php-swiss-cantons"
```

## Usage
Use the `CantonManager`  Class to interact with this package. Below you find an example how you can use this package in the Laravel Framework. Further you find all the public API for `CantonManager` and `Canton`

```php
Route::get('/', function (Wnx\SwissCantons\CantonManager $cantonManager) {

    $canton = $cantonManager->getByAppreviation(Request::get('canton', 'ZH'));
    $cantonName = $canton->setLanguage('de')->getName();

		return view('welcome', compact('cantonName'));

});
```

## `CantonManager`

Use the `CantonManager` to find a Canton. It will return a new Instance of `Canton` or will throw an `Exception` if it could't find anything.

### `getByAppreviation()`

Find a Canton by its abbreviation. See [this list](https://en.wikipedia.org/wiki/Cantons_of_Switzerland#List) for available abbreviations.

```php
$cantonManager = new Wnx\SwissCantons\CantonManager();

$canton = $cantonManager->getByAppreviation('GR');
```

### `getByName()`

Search for a Canton by it's name. The name must exactly match one of the translations of the Canton (German, French, Italian, Romansh or English).

```php
$cantonManager = new Wnx\SwissCantons\CantonManager();

$canton = $cantonManager->getByName('Zürich');
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
Return the Name for the given Canton. If this method is used without calling the `setLanguage()` Method before, it will return the name in English.

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

If you discover a security vulnerability within this package, please e-mail us at hello@stefanzweifel.io. All security vulnerabilities will be promptly addressed.

## License

MIT