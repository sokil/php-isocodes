## 3.3.1 (2021-01-03)
* Database version: iso-codes-4.5.0-178-g802915de from 2021-01-02 04:38

## 3.3.0 (2020-12-20)
* Fix configure external directory to database files
* `SomeDatabase::getByNumericCode` now accept strings instead of ints, `SomeEntity::getNumericCode` now return strings

## 3.2.0 (2020-12-13)
* Allow to configure own translation driver

## 3.1.1 (2020-12-12)
* Database updated to version iso-codes-4.5.0-165-g46cea063 from 2020-12-12 19:09
* Fixed release scripts
* Configured Github Action to start automatic release process event 2nd day of month

## 3.1.0 (2020-12-09)
* Bug #25 fixed, \Sokil\IsoCodes\Database\Countries::getByNumericCode now accept strings instead of ints

## 3.0.6 (2020-09-22)
* Database version: 4.5.0-99-g3feba234 from 2020-09-22 23:33

## 3.0.5 (2020-05-29)
* Database version: 4.2-515-g7c579bb0 from 2020-05-29 01:27

## 3.0.4 (2019-11-28)
* Database version: 4.2-299-gc0e8506 from 2019-11-28 08:56

## 3.0.3 (2019-10-23)
* Database version: 4.2-277-g3d1d2f11 from 2019-10-23 22:24

## 3.0.2 (2019-08-28)
* Database version: iso-codes-4.2-202-gfefebff3 from 2019-08-28 23:03

## 3.0.1 (2019-06-21)
* Remove stub class \Sokil\IsoCodes, use \Sokil\IsoCodes\IsoCodesFactory instead
* Database version: iso-codes-4.2-147-gcadebc34

## 3.0 (2019-05-04)
* PHP >=7.1 required.
* Cluster index is now lazy loaded. If you use iterator methods directly to iterate through all database, 
  you must call `rewind` first.
* Factory now creates database instances but not store them, so next call of factory method will create new instance.
* Subdivisions and languages databases are large, so they have now optimisation to load entries from separate files instead of one single file..

## 2.2.9 (2019-08-28)
* Database version: iso-codes-4.2-202-gfefebff3 from 2019-08-28 23:05

## 2.2 (2018-11-29)
* Added possibility to configure directory with databases and messages, and manually update them without updating composer 
* Constants `AbstractDatabase::DATABASE_PATH` and `AbstractDatabase::MESSAGES_PATH` now contain directory name instead of directory path

## 2.1 (2018-05-08)
* `AbstractDatabase::find()` now returns null when $fieldValue not found in index instead of throwing exception 

## 2.0 (2017-11-05)

* Updated pkg-isocodes database. Added update script.
* Replace class `\Sokil\IsoCodes` with `\Sokil\IsoCodes\IsoCodesFactory`. First is deprecated now.
* Removed Historic currencies
* Moved database classes from `\Sokil\IsoCodes\*` to `\Sokil\IsoCodes\Database`
* Entry's public properties replaced with getters
* Completely rewritted country's subdivisions database
