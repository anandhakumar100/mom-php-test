# Mom Technical Test

A user can generate reports (Report.php) and send them via email (Mailer.php) in different formats like HTML or JSON.

There is a bunch of bad practices, anti-patterns and broken SOLID principles in the given code.

The objective of this test is to perform a refactor in order to have a more maintainable, robust and understandable application.

- You can freely create files, classes and methods and break the code into the pieces you consider
- The code is written in PHP 5.6, up to you to improve it with PHP 7 new features
- Add the unit tests you seem fit to test your refactor

## Requeriments

- PHP 5.6 or higher installed.
- Composer installed (see https://getcomposer.org/download/)

## How to run the unit tests

- `composer install`
- `/vendor/bin/phpunit src` or `make test`
