# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased](https://github.com/stefanzweifel/php-swiss-cantons/compare/3.1.0...HEAD)

## [v3.1.0](https://github.com/stefanzweifel/php-swiss-cantons/compare/3.0.0...3.1.0) - 2020-11-01

### Added
- Add Support for PHP 8 [#36](https://github.com/stefanzweifel/php-swiss-cantons/pull/36)


## [v3.0.0](https://github.com/stefanzweifel/php-swiss-cantons/compare/2.1.0...3.0.0) - 2020-02-22

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

## [v2.1.0](https://github.com/stefanzweifel/php-swiss-cantons/compare/2.0.1...2.1.0) - 2020-02-19

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
