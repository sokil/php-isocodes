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
