# Changelog

All notable changes to `laravel-helpers` will be documented in this file

## 5.0.0 - Added compatibility with Laravel 12 - 2025-05-28

-   Added compatibility with Laravel 12
-   Updated PHP requirement to ^8.2
-   Updated fakerphp/faker to ^1.24.0
-   Updated PHPUnit to ^11.0
-   Updated Orchestra Testbench to ^10.0
-   Updated GitHub Actions workflows to use PHP 8.2, Laravel 12 and actions/checkout@v4
-   Updated phpunit.xml.dist configuration to be compatible with PHPUnit 11
-   Modernized tests by replacing PHPUnit DocBlock annotations with PHP 8 attributes
-   Fixed data provider methods to be static as required by PHPUnit 11
-   Disabled code coverage reporting by default to prevent warnings

## 4.0.0 - Added PHP 8.1 support & Laravel 9 - 2023-02-21

-   Added PHP 8.1 support
-   Upgrade to Laravel 9

## 3.0.0 - Drop PHP support below PHP 8 - 2021-07-14

-   Drop PHP support below PHP 8

## 2.0.0 - PHP 8 support & fakerphp - 2021-02-07

-   Added PHP 8 support
-   Change to fakerphp/faker
-   Update friendsofphp/php-cs-fixer

## 1.2.0 - Added new helpers - 2020-10-04

**dump_sql**

Returns sql query with bindings data.

```php
dump_sql(\DB::table('users')->where('email', "blaBla")->where('id', 1));
// returns "select * from `users` where `email` = 'blaBla' and `id` = 1"
```

**faker**

Shortcut for: $faker = Faker\Factory::create()

```php
faker('address'); // alternate syntax
```

**stopwatch**

Returns the amount of time (in seconds) the provided callback took to execute. Useful for debugging and profiling.

```php
stopwatch(function () {
    sleep(2);
}); // returns "2.0"
```

**str_between**

```php
str_between('--thing--', '--'); // returns "thing"
```

**money**

```php
echo money(12); // echoes "$12.00"
```

**str_wrap**

```php
str_wrap('thing', '--'); // returns "--thing--"
```

## 1.1.0 - 2020-09-11

-   Added Laravel 8 support

## 1.0.0 - 2020-07-06

-   initial release
