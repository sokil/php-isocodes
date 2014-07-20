PHP ISO Codes
=========

Based on Python's [pycountry](https://pypi.python.org/pypi/pycountry) and Debian's [iso-codes](http://pkg-isocodes.alioth.debian.org/). This library used to get localized names of countries, currencies, languages and scripts.

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
