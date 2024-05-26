# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased](https://github.com/stefanzweifel/php-swiss-cantons/compare/v5.0.0...HEAD)

> TBD

## [v5.0.0](https://github.com/stefanzweifel/php-swiss-cantons/compare/v4.4.0...v5.0.0) - 2024-05-26

### Breaking Changes

**Public**

- The signature of `getByZipcode()` changed. The method now returns an array of possible Cantons instead of the first Canton that matched. (Some zipcodes can belong to multiple cantons. For example 1290)
- A new `getByZipcodeAndCity()` method has been added that accepts a zipcode and optionally a city name to drill down the search further.

**Internal**

- `ZipcodeSearch`-class has been renamed to `CitySearch`
- `zipcodes.json` has been renamed to `cities.json`

### Added

- Update cities.json dataset ([#47](https://github.com/stefanzweifel/php-swiss-cantons/pull/47))
- Handle multiple cities and cantons per zipcode ([#47](https://github.com/stefanzweifel/php-swiss-cantons/pull/47))

### Changed

- Replace Psalm with Phpstan ([#45](https://github.com/stefanzweifel/php-swiss-cantons/pull/45))

## [v4.4.0](https://github.com/stefanzweifel/php-swiss-cantons/compare/v4.3.0...v4.4.0) - 2023-10-16

### Added

- Add Support for PHP 8.3 ([#44](https://github.com/stefanzweifel/php-swiss-cantons/pull/44))

## [v4.3.0](https://github.com/stefanzweifel/php-swiss-cantons/compare/4.2.0...v4.3.0) - 2023-04-16

### Removed

- Drop Support for PHP versions below PHP 8.2 ([#43](https://github.com/stefanzweifel/php-swiss-cantons/pull/43))
- Add Support for Phpunit v10 ([#42](https://github.com/stefanzweifel/php-swiss-cantons/pull/42))

## [4.2.0](https://github.com/stefanzweifel/php-swiss-cantons/compare/4.1.0...4.2.0) - 2022-10-29

### Added

- Support for PHP 8.2 ([#40](https://github.com/stefanzweifel/php-swiss-cantons/pull/40))

## [4.1.0](https://github.com/stefanzweifel/php-swiss-cantons/compare/4.0.0...4.1.0) - 2021-10-24

### Changed

- Update dataset [b7ce524b0978494fd0316fc2b1050cd1170dddbd](https://github.com/stefanzweifel/php-swiss-cantons/commit/b7ce524b0978494fd0316fc2b1050cd1170dddbd)
- Sort dataset by zipcode and name [3328e3db702efec94aec006266be7224d7e33598](https://github.com/stefanzweifel/php-swiss-cantons/commit/3328e3db702efec94aec006266be7224d7e33598)

## [4.0.0](https://github.com/stefanzweifel/php-swiss-cantons/compare/3.1.0...4.0.0) - 2021-04-25

**Note:** The public API of the package didn't change, but the zipcodes dataset now uses data from the Swiss Post (instead of the Swiss cadastral system website). The detection of the canton for a zipcode still works the same as before.

If you've been using `zipcodes.json` directly, please see [#38](https://github.com/stefanzweifel/php-swiss-cantons/pull/38) for details.

### Changed

- Update Zipcodes Dataset to 2021 [#38](https://github.com/stefanzweifel/php-swiss-cantons/pull/38)

## [3.1.0](https://github.com/stefanzweifel/php-swiss-cantons/compare/3.0.0...3.1.0) - 2020-11-01

### Added

- Add Support for PHP 8 [#36](https://github.com/stefanzweifel/php-swiss-cantons/pull/36)

## [3.0.0](https://github.com/stefanzweifel/php-swiss-cantons/compare/2.1.0...3.0.0) - 2020-02-22

### Changed

- Replace most of the internal doc blocks with Type Hints, Return Type and Property Types
- Internally, data sets are now always cast to arrays instead of objects
- Update README with better examples on how to use the package
- Switch from Travis to GitHub Actions for testing
- Passing an invalid language to `Canton@setLanguage`  now throws `InvalidLanguageException`
- If a Canton can't be found either by abbreviation, name or zipcode `CantonException` is thrown

### Removed

- Drop support for PHP 7.2
- Drop support for PHP 7.3
- Remove Code documentation folder `/docs`

## [2.1.0](https://github.com/stefanzweifel/php-swiss-cantons/compare/2.0.1...2.1.0) - 2020-02-19

### Removed

- Drop support for PHP 7.0
- Drop support for PHP 7.1
- Remove Liechtenstein Zipcodes from Dataset [#27](https://github.com/stefanzweifel/php-swiss-cantons/issues/27), [#31](https://github.com/stefanzweifel/php-swiss-cantons/pull/31)
- Remove duplicate zipcode for "Le Locle" [#28](https://github.com/stefanzweifel/php-swiss-cantons/issues/28), [#29](https://github.com/stefanzweifel/php-swiss-cantons/pull/29)

## v2.0.1 (2017-11-01)

- Fix Typo for "Fribourg"

## v2.0.0 (2017-10-31)

- Fix silly typo (appreviation => abbreviation) which causes breaking changes ([#21](https://github.com/stefanzweifel/php-swiss-cantons/pull/21))

## V1.4.0 (2017-07-26)

- Add a new `Cantons` class to generate a list of all Swiss Cantons ([#18](https://github.com/stefanzweifel/php-swiss-cantons/pull/18))

## V1.3.0 (2017-05-03)

- Fix wrong translations ([#16](https://github.com/stefanzweifel/php-swiss-cantons/pull/16))

## V1.2.1 (2016-10-04)

- Fix an issue where lower case Canton abbreviations throws an error [#11](https://github.com/stefanzweifel/php-swiss-cantons/issues/11)
- Fix an issue where Zipcodes passed as a Strings throws an error [#12](https://github.com/stefanzweifel/php-swiss-cantons/issues/12)

## V1.2.0 (2016-09-16)

- Remove `tightenco/collect` as a dependency and switch to good old `array_filter`

## V1.1.0 (2016-09-16)

- Add `getByZipcode`

## V1.0.0 (2016-07-14)

- Add Changelog
- Update Readme

## V0.0.1 (2016-06-29)

- Testing Release
