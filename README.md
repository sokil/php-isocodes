PHP ISO Codes
=========
[![Build Status](https://travis-ci.org/sokil/php-isocodes.png?branch=master&1)](https://travis-ci.org/sokil/php-isocodes)
[![Latest Stable Version](https://poser.pugx.org/sokil/php-isocodes/v/stable.png)](https://packagist.org/packages/sokil/php-isocodes)
[![Coverage Status](https://coveralls.io/repos/sokil/php-isocodes/badge.png)](https://coveralls.io/r/sokil/php-isocodes)
[![Total Downloads](http://img.shields.io/packagist/dt/sokil/php-isocodes.svg?1)](https://packagist.org/packages/sokil/php-isocodes)
[![Daily Downloads](https://poser.pugx.org/sokil/php-isocodes/d/daily)](https://packagist.org/packages/sokil/php-isocodes/stats)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sokil/php-isocodes/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sokil/php-isocodes/?branch=master)

This library used to get localized names of countries, currencies, languages and scripts.
Based on Python's [pycountry](https://pypi.python.org/pypi/pycountry) and Debian's [iso-codes](https://salsa.debian.org/iso-codes-team/iso-codes.git).

Database version: iso-codes-3.77-628-g360ef4e from 2018-08-20 16:31

ISO Standarts
-------------

* **ISO 3166-1**: Country codes (alpha-2, alpha-3, numeric)
* **ISO 3166-2**: Principal subdivisions (e.g., provinces or states) of all countries coded in ISO 3166-1
* **ISO 3166-3**: Historic countries (alpha-2, alpha-3, alpha-4, numeric)
* **ISO 15924**: Scripts
* **ISO 4217**: Currencies
* **ISO 639-3**: Languages

Installation
------------

You can install library through Composer:
```
composer require sokil/php-isocodes
```

Usage
------

* [Locale configuration](#locale-configuration)
* [Countries database (ISO 3166-1)](#countries-database-iso-3166-1)
* [Subdivisions database (ISO 3166-2)](#subdivisions-database-iso-3166-2)
* [Historic countries database (ISO 3166-3)](#historic-countries-database-iso-3166-3)
* [Scripts database (ISO 15924)](#scripts-database-iso-15924)
* [Currencies database (ISO 4217)](#currencies-database-iso-4217)
* [Languages database (ISO 639-3)](#languages-database-iso-639-3)

### Locale configuration

Before using IsoCodes database you need to setup valid locale to get transtions worked:

```php
<?php

// define locale
putenv('LANGUAGE=uk_UA.UTF-8');
putenv('LC_ALL=uk_UA.UTF-8');
setlocale(LC_ALL, 'uk_UA.UTF-8');

// init database
$isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();

// get languages database
$languages = $isoCodes->getLanguages();

// get local name of language
echo $languages->getByAlpha2('uk')->getLocalName(); // will print 'українська'
```

To get list of available locales, execute under console:
```sh
$ locale -a
```
```
uk_UA
uk_UA.koi8u
uk_UA.utf8
```

If you don't see required locales in list, you may install them manually (for Ubuntu):
```sh
$ locale-gen uk_UA.utf8
```
```
Generating locales...
  uk_UA.utf-8... done
Generation complete.
```

### Countries database (ISO 3166-1)

Get localized name of country by it's alpha2 code:
```php
$isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
$isoCodes->getCountries()->getByAlpha2('UA')->getLocalName();
```

Get localized name of country by it's alpha2 code:
```php
$isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
$isoCodes->getCountries()->getByAlpha2('UKR')->getName();
```

Get localized name of country by it's numeric code:
```php
$isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
$isoCodes->getCountries()->getByAlpha2('804')->getName();
```

Get  localised list of countries
```php
$isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
foreach($isoCodes->getCountries() as $country) {
  echo $country->getLocalName();
}
```

### Subdivisions database (ISO 3166-2)

```php
<?php

$isoCodes = new IsoCodesFactory();

$subDivisions = $isoCodes->getSubdivisions();

// get subdivision by code
$subDivision = $subDivisions->getByCode('UA-43');

// get subdivision code
$subDivision->getCode(); // UA-43

// get subdivision name
$subDivision->getName(); // Respublika Krym
    
// get localised subdivision name
$subDivision->getLocalName(); // Автономна Республіка Крим

// get subdivision type
$subDivision->getType(); // 'Autonomous republic'
```

### Historic countries database (ISO 3166-3)

### Scripts database (ISO 15924)

### Currencies database (ISO 4217)

### Languages database (ISO 639-3)


See also
--------

* [State Classifier of objects of administrative and territorial structure of Ukraine](https://github.com/sokil/koatuu) - generates database of detailed list of cities and settlements of Ukraine
* [A Symfony's PHP replacement layer for the C intl extension that also provides access to the localization data of the ICU library](http://symfony.com/doc/current/components/intl.html)
