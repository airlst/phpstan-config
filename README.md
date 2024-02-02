# PHPStan config for AirLST projects

[![Latest Version on Packagist](https://img.shields.io/packagist/v/airlst/rector-config.svg?style=flat-square)](https://packagist.org/packages/airlst/rector-config)
[![Total Downloads](https://img.shields.io/packagist/dt/airlst/rector-config.svg?style=flat-square)](https://packagist.org/packages/airlst/rector-config)

PHPStan config for AirLST projects.

## Installation

You can install the package via Composer:

```bash
composer require --dev airlst/phpstan-config
```

## Usage

Create a `phpstan.php` in the root of your project with the following contents:

```php
<?php

declare(strict_types=1);

$factory = new Airlst\PhpstanConfig\Factory(['src']);

return $factory->level(8)->create();
```

The constructor of the `Factory` class takes an array of paths to be scanned for PHP files and analyzed. You can pass any number of paths to it.

### Configuration

You can use following configuration options on the `Factory` class by chaining them before `create()` call:

- `level(int $level)`: Set the level of PHPStan
- `with(string $file)`: Include additional PHPStan neon file
- `without(string $file)`: Exclude provided PHPStan neon file
- `withBleedingEdge()`: Use [bleeding edge version](https://phpstan.org/blog/what-is-bleeding-edge) of PHPStan
- `useCacheDir(string $cacheDir)`: Use cache directory for PHPStan
- `ignoreError(string $message, ?string $path, ?int $count, ?bool $reportUnmatched)`: Ignore provided error message
- `checkMissingIterableValueType(bool $enable = true)`: Enables/Disables `checkMissingIterableValueType` rule
- `checkGenericClassInNonGenericObjectType(bool $enable = true)`: Enables/Disables `checkGenericClassInNonGenericObjectType` rule

### Running PHPStan

Run PHPStan with the following command:

```shell
./vendor/bin/phpstan analyse -c phpstan.php
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
