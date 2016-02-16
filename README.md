PHP ISO Codes
=========
[![Build Status](https://travis-ci.org/sokil/php-isocodes.png?branch=master&1)](https://travis-ci.org/sokil/php-isocodes)
[![Latest Stable Version](https://poser.pugx.org/sokil/php-isocodes/v/stable.png)](https://packagist.org/packages/sokil/php-isocodes)
[![Coverage Status](https://coveralls.io/repos/sokil/php-isocodes/badge.png)](https://coveralls.io/r/sokil/php-isocodes)
[![Total Downloads](http://img.shields.io/packagist/dt/sokil/php-isocodes.svg)](https://packagist.org/packages/sokil/php-isocodes)

This library used to get localized names of countries, currencies, languages and scripts.
Based on Python's [pycountry](https://pypi.python.org/pypi/pycountry) and Debian's [iso-codes](http://pkg-isocodes.alioth.debian.org/).

Installation
------------

You can install library through Composer:
```json
{
    "require": {
        "sokil/php-isocodes": "dev-master"
    }
}
```

Useage
------

Before using IsoCodes database you need to setup valid locale to get transtions worked:

```php
<?php

// define locale
putenv('LANGUAGE=uk_UA.UTF-8');
putenv('LC_ALL=uk_UA.UTF-8');
setlocale(LC_ALL, 'uk_UA.UTF-8');

// init database
$isoCodes = new \Sokil\IsoCodes;

// get languages database
$languages = $isoCodes->getLanguages();

// get local name of language
echo $languages->getByAlpha2('uk')->getLocalName(); // will print 'українська'
```

Countries
---------

Get localized name of country by it's alpha2 code:
```php
$isoCodes = new \Sokil\IsoCodes;
$isoCodes->getCountries()->getByAlpha2('UA')->getLocalName();
```

Get localized name of country by it's alpha2 code:
```php
$isoCodes = new \Sokil\IsoCodes;
$isoCodes->getCountries()->getByAlpha2('UKR')->getName();
```

Get localized name of country by it's numeric code:
```php
$isoCodes = new \Sokil\IsoCodes;
$isoCodes->getCountries()->getByAlpha2('804')->getName();
```

Get  localised list of countries
```php
$isoCodes = new \Sokil\IsoCodes;
foreach($isoCodes->getCountries() as $country) {
  echo $country->getLocalName();
}
