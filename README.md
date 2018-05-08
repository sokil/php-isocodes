PHP ISO Codes
=========
[![Build Status](https://travis-ci.org/sokil/php-isocodes.png?branch=master&1)](https://travis-ci.org/sokil/php-isocodes)
[![Latest Stable Version](https://poser.pugx.org/sokil/php-isocodes/v/stable.png)](https://packagist.org/packages/sokil/php-isocodes)
[![Coverage Status](https://coveralls.io/repos/sokil/php-isocodes/badge.png)](https://coveralls.io/r/sokil/php-isocodes)
[![Total Downloads](http://img.shields.io/packagist/dt/sokil/php-isocodes.svg?1)](https://packagist.org/packages/sokil/php-isocodes)
[![Daily Downloads](https://poser.pugx.org/sokil/php-isocodes/d/daily)](https://packagist.org/packages/sokil/php-isocodes/stats)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sokil/php-isocodes/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sokil/php-isocodes/?branch=master)

This library used to get localized names of countries, currencies, languages and scripts.
Based on Python's [pycountry](https://pypi.python.org/pypi/pycountry) and Debian's [iso-codes](http://pkg-isocodes.alioth.debian.org/).

Database version: iso-codes-3.79-69-g060cd4dd from 2018-05-08 22:22

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

Countries
---------

Get localized name of country by it's alpha2 code:
```php
$isoCodes = new \Sokil\IsoCodes\IsoCodesFactory();
$isoCodes->getCountries()->getByAlpha2('UA')->getLocalName();
```

Get localized name of country by it's alpha2 code:
```php
$isoCodes = new \Sokil\IsoCodes;
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
