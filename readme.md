# Laravel Extend Collections

*A few extensions to the [Laravel](https://laravel.com) Collection and Arr.*

## Installation

`composer require konsulting/laravel-extend-collections`

### Using Laravel
This package will auto-register the service provider.

### Not using Laravel
There is a simple namespaced helper function to assist with extending Collection and Arr.

```php
// Inside your application code, run:

\Konsulting\Laravel\load_collection_extensions();
```

## Arr Extensions
* `fromDot` - convert an array where the keys are dot-notation indexed to a nested array

## Collection extensions
* `dropEmpty` - drop items whose values are `empty()`
* `deep` - apply a function recursively through a collection, and through arrays/collections within it
* `dotGet` - retrieve an item using dot-notation
* `dotSet` - set an item using dot-notation
* `dotHas` - check if an item exists using dot-notation
* `dot` - now standard in Laravel as `dot`.
* `fromDot` - convert a dot-notation indexed collection to a nested collection - now standard in Laravel as `undot`. Kept for backwards compatibility.

## Contributing

Contributions are welcome and will be fully credited. We will accept contributions by Pull Request.

Please:

* Use the PSR-2 Coding Standard
* Add tests, if you’re not sure how, please ask.
* Document changes in behaviour, including readme.md.

## Testing
We use [PHPUnit](https://phpunit.de)

Run tests using PHPUnit: `vendor/bin/phpunit`
