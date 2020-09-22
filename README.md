# PHP ISO Codes

[![Build Status](https://travis-ci.org/sokil/php-isocodes.png?branch=master&1)](https://travis-ci.org/sokil/php-isocodes)
[![Latest Stable Version](https://poser.pugx.org/sokil/php-isocodes/v/stable.png)](https://packagist.org/packages/sokil/php-isocodes)
[![Coverage Status](https://coveralls.io/repos/sokil/php-isocodes/badge.png)](https://coveralls.io/r/sokil/php-isocodes)
[![Total Downloads](http://img.shields.io/packagist/dt/sokil/php-isocodes.svg?1)](https://packagist.org/packages/sokil/php-isocodes)
[![Daily Downloads](https://poser.pugx.org/sokil/php-isocodes/d/daily)](https://packagist.org/packages/sokil/php-isocodes/stats)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sokil/php-isocodes/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sokil/php-isocodes/?branch=master)

:star: This library used to get localized names of countries, currencies, languages and scripts.

:package: Based on Python's [pycountry](https://pypi.python.org/pypi/pycountry) and Debian's [iso-codes](https://salsa.debian.org/iso-codes-team/iso-codes.git).

:1234: Database version: iso-codes-4.5.0-99-g3feba234 from 2020-09-22 23:33

:tongue: Current translation status: https://salsa.debian.org/iso-codes-team/iso-codes#status-of-translations

## Table of contents

* [ISO Standards](#iso-standarts)
* [Installation](#installation)
* [Locale configuration](#locale-configuration)
* [Manual database update](#manual-database-update)
* [Usage](#usage)
  * [Locale configuration](#locale-configuration)
  * [Countries database (ISO 3166-1)](#countries-database-iso-3166-1)
  * [Subdivisions database (ISO 3166-2)](#subdivisions-database-iso-3166-2)
  * [Historic countries database (ISO 3166-3)](#historic-countries-database-iso-3166-3)
  * [Scripts database (ISO 15924)](#scripts-database-iso-15924)
  * [Currencies database (ISO 4217)](#currencies-database-iso-4217)
  * [Languages database (ISO 639-3)](#languages-database-iso-639-3)
* [Tests](#tests)

## ISO Standards

* **ISO 3166-1**: Country codes (alpha-2, alpha-3, numeric)
* **ISO 3166-2**: Principal subdivisions (e.g., provinces or states) of all countries coded in ISO 3166-1
* **ISO 3166-3**: Historic countries (alpha-2, alpha-3, alpha-4, numeric)
* **ISO 15924**: Scripts
* **ISO 4217**: Currencies
* **ISO 639-3**: Languages

## Installation

You can install library through Composer:
```
composer require sokil/php-isocodes
```

## Locale configuration

Before using IsoCodes database you need to setup valid locale to get translations worked:

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

## Manual database update

Database and related gettext files located inside this repo in `databases` and `messages` directories.
This data periodically updated with package version increment.

If you want to update database more often, use script `./bin/update_iso_codes_db.sh`.
Call this script by cron, during deploy process or when build your docker image.

```
/path/to/project/vendor/sokil/php-isocodes/bin/update_iso_codes_db.sh /var/isocodes
```

Now you need to configure factory to use this directory:

```php
<?php

$databaseBaseDir = '/var/isocodes';

$isoCodes = new \Sokil\IsoCodes\IsoCodesFactory($databaseBaseDir);
```

## Usage

* [Factory](#factory)
* [Countries database (ISO 3166-1)](#countries-database-iso-3166-1)
* [Subdivisions database (ISO 3166-2)](#subdivisions-database-iso-3166-2)
* [Historic countries database (ISO 3166-3)](#historic-countries-database-iso-3166-3)
* [Scripts database (ISO 15924)](#scripts-database-iso-15924)
* [Currencies database (ISO 4217)](#currencies-database-iso-4217)
* [Languages database (ISO 639-3)](#languages-database-iso-639-3)

### Factory

All databases may be create through factory:

```php
<?php
$isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
$languages = $isoCodes->getLanguages();
```

There are large databases: subdivisions and languages.
Loading of entire database into memory may require lot of RAM and time to create all entries in memory.
  
So there are scenarios of usage: with optimisations of memory and with optimisation of time.

#### Memory optimisation

Database splits into partition files.

Fetching some entry will load only little part of database.
Loaded entries not stored statically.

This scenario may be useful when just few entries need
to be loaded, for example on web request when one entry fetched.

This may require a lot of file read operations.
     
#### Input-output optimisations

Entire database loaded into memory from single JSON file once.

All entries created and stored into RAM. Next read of save
entry will just return it without io operations with files and building objects.

This scenario may be useful for daemons to decrease file operations,
or when most entries will be fetched from database.

This may require a lot of RAM for storing all entries.
     
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

```php
<?php

$isoCodes = new IsoCodesFactory();

$countries = $isoCodes->getHistoricCountries();

$country = $countries->getByAlpha4('ZRCD');

$country->getName(); //'Zaire, Republic of'
$country->getAlpha4(); // 'ZRCD'
$country->getAlpha3(); // 'ZAR'
$country->getAlpha2(); // 'ZR'
$country->getWithdrawalDate(); // '1997-07-14'
$country->getNumericCode(); // 180
```

### Scripts database (ISO 15924)

```php
<?php
$isoCodes = new IsoCodesFactory();

$scripts = $isoCodes->getScripts();

$script = $scripts->getByAlpha4('Aghb');

$script->getName(); // Caucasian Albanian
$script->getLocalName(); // кавказька албанська
$script->getAlpha4(); // Aghb
$script->getNumericCode(); 239
```

### Currencies database (ISO 4217)

```php
<?php

$isoCodes = new IsoCodesFactory();

$currencies = $isoCodes->getCurrencies();

$currency = $currencies->getByLetterCode('CZK');

$currency->getName(); // Czech Koruna
$currency->getLocalName(); // Чеська крона
$currency->getLetterCode(); // CZK
$currency->getNumericCode(); // 203
```

### Languages database (ISO 639-3)

```php
<?php
$isoCodes = new IsoCodesFactory();

$languages = $isoCodes->getLanguages();

$language = $languages->getByAlpha2('uk');

$language->getAlpha2(); // uk

$language->getName(); // Ukrainian

$language->getLocalName(); // українська

$language->getAlpha3(); // ukr

// Scope of denotation, see mote at https://iso639-3.sil.org/about/scope
$language->getScope(); // I

// Type of language, see https://iso639-3.sil.org/about/types
$language->getType(); // L

$language->getInvertedName(); // null
```

## Tests

To start docker tests run following command:
```
./tests/docker/run-test.sh [PHP_VERSION]
```

For example for PHP 7.1 run following command:
```
./tests/docker/run-test.sh 7.1
```


## See also

* [State Classifier of objects of administrative and territorial structure of Ukraine](https://github.com/sokil/koatuu) - generates database of detailed list of cities and settlements of Ukraine
* [A Symfony's PHP replacement layer for the C intl extension that also provides access to the localization data of the ICU library](http://symfony.com/doc/current/components/intl.html)
* [FamFacFam icon pack with flags](http://www.famfamfam.com/lab/icons/flags/)
